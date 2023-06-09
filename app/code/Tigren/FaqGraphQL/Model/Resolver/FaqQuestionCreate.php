<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Model\Resolver;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Tigren\FaqGraphQL\Model\Faq;
use Tigren\FaqGraphQL\Model\FaqFactory;
use Tigren\FaqGraphQL\Model\ResourceModel\Faq as Resource;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class FaqQuestionCreate implements ResolverInterface
{
    private FaqFactory $faqFactory;
    private Resource $resource;
    private CollectionFactory $productCollectionFactory;

    public function __construct(
        Resource $resource,
        FaqFactory $faqFactory,
        Faq $faqModel,
        CollectionFactory $productCollectionFactory
    ) {
        $this->faqFactory = $faqFactory;
        $this->resource = $resource;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        $data = $args;
        if ($data) {
            $model = $this->faqFactory->create();

            $sku = $data['product'];

            $productCollection = $this->productCollectionFactory->create();
            $productCollection->addAttributeToFilter('sku', $sku);
            $productCollection->setPageSize(1);
            $productId = $productCollection->getFirstItem()->getData('entity_id');

            $data['product'] = $productId;

            $data['status'] = 'Pending';

            $data['position'] = '0';

            $model->setData($data);
            if($data['question'] == false || $data['author'] == ''){
                return [
                    "success" => false,
                    "message" => 'Empty question or author name',
                ];
            }
            try {
                $this->resource->save($model);
                return [
                    "success" => true,
                    "message" => "Question created successfully!",
                ];
            } catch (LocalizedException $exception) {
                return [
                    "success" => false,
                    "message" => $exception,
                ];
            } catch (Exception $e) {
                return [
                    "success" => false,
                    "message" => $e,
                ];
            }
        }
        return [
            "success" => false,
            "message" => "No data passed",
        ];
    }
}

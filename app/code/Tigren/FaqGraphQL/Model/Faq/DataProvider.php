<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Model\Faq;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use Tigren\FaqGraphQL\Model\ResourceModel\Faq\CollectionFactory;
use Tigren\FaqGraphQL\Model\ResourceModel\Faq as FaqResource;
use Tigren\FaqGraphQL\Model\FaqFactory;
use Tigren\FaqGraphQL\Model\Faq;

class DataProvider extends ModifierPoolDataProvider
{
    private array $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        private readonly FaqResource $resource,
        private readonly FaqFactory $faqFactory,
        private readonly RequestInterface $request,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData(): array
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }

        $faq = $this->getCurrentFaq();
        $this->loadedData[$faq->getId()] = $faq->getData();
        return $this->loadedData;
    }

    private function getCurrentFaq(): Faq
    {

        $faqId = $this->getFaqId();
        $faq = $this->faqFactory->create();
        if(!$faqId){
            return $faq;
        }

        $this->resource->load($faq, $faqId);

        return $faq;
    }

    private function getFaqId(): int
    {
        return (int) $this->request->getParam('faq_id');
    }
}

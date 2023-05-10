<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Tigren\FaqGraphQL\Model\Faq;
use Tigren\FaqGraphQL\Model\FaqFactory;

class FaqQuestionList implements ResolverInterface
{
    private FaqFactory $faqFactory;

    public function __construct(
        FaqFactory $faqFactory,
        Faq $faqModel
    ) {
        $this->faqFactory = $faqFactory;
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
        $faqFactory = $this->faqFactory->create();

        $collection = $faqFactory->getCollection();
        $collection->getSelect()->order('position DESC');

        return $collection->getData();
    }
}

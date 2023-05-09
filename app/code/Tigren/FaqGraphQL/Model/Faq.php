<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'Tigren_faq_graphql';
    protected function _construct(): void
    {
        $this->_init('Tigren\FaqGraphQL\Model\ResourceModel\Faq');
    }
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}

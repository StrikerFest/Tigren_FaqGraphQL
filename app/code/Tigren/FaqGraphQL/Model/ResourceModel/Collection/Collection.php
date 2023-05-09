<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Model\ResourceModel\Collection;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends
    AbstractCollection {
    protected function _construct(): void
    {
        $this->_init('Tigren\FaqGraphQL\Model\Collection','Tigren\FaqGraphQL\Model\ResourceModel\Collection');
    }
}

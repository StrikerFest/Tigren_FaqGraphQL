<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const CONFIG_MODULE_IS_ENABLED = 'faq/general/enable';


    public function getDefaultConfig($path)
    {
        return $this->scopeConfig->getValue($path);
    }

    public function isModuleEnabled(): bool
    {
        return (bool) $this->getDefaultConfig(self::CONFIG_MODULE_IS_ENABLED);
    }
}

<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Block\Adminhtml\Faq;
use Magento\Backend\Block\Widget\Grid\Container;

class Grid extends Container
{
    protected function _construct(): void
    {
        $this->_blockGroup = 'Tigren_FaqGraphQL';
        $this->_controller = 'adminhtml_faq';
        $this->_headerText = __('Manage Faq');
        $this->_addButtonLabel = __('Add New Faq');
        parent::_construct();
    }
}

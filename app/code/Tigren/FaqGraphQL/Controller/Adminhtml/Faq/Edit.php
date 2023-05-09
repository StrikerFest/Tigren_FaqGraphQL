<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Controller\Adminhtml\Faq;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Edit extends Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute(): Page
    {

        $pageResult = $this->createPageResult();
        $title = $pageResult->getConfig()->getTitle();
        $title->prepend(__('Faqs'));
        $title->prepend(__('New Faqs'));

        return $pageResult;

    }
        private function createPageResult(): Page|ResultInterface
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

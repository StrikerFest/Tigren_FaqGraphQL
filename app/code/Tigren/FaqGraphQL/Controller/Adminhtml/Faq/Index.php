<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected bool|PageFactory $resultPageFactory = false;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute(): Page|ResultInterface|ResponseInterface
    {
        // Call page factory to render layout and page content
        $resultPage = $this->resultPageFactory->create();
        // Set the menu which will be active for this page
        $resultPage->setActiveMenu('Tigren_FaqGraphQL::faq_manage');
        // Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Faqs GraphQL Version'));
        return $resultPage;

    }
}

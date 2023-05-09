<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Controller\Adminhtml\Faq;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Throwable;
use Tigren\FaqGraphQL\Model\ResourceModel\Faq as FaqResource;
use Tigren\FaqGraphQL\Model\FaqFactory;

class Delete extends Action implements HttpPostActionInterface
{
    /**
     * Delete constructor.
     * @param Context $context
     * @param FaqResource $resource
     * @param FaqFactory $faqFactory
     */
    public function __construct(
        Context $context,
        private readonly FaqResource $resource,
        private readonly FaqFactory $faqFactory
    ) {
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     * @throws Exception
     */
    public function execute(): ResultInterface
    {
        $faqId = (int) $this->getRequest()->getParam('faq_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$faqId) {
            $this->messageManager->addErrorMessage(__('We can\'t find a faq to delete'));
            return $resultRedirect->setPath('*/*/');
        }

        $model = $this->faqFactory->create();

        try {
            $this->resource->load($model, $faqId);
            $this->resource->delete($model);

            $this->messageManager->addSuccessMessage(__('The faq has been deleted.'));
        } catch (Throwable $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        return $resultRedirect->setPath('*/*/');
    }
}

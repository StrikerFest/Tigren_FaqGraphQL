<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Throwable;
use Tigren\FaqGraphQL\Model\FaqFactory;
use Tigren\FaqGraphQL\Model\ResourceModel\Faq as FaqResource;

class Save extends Action implements HttpPostActionInterface
{

    public function __construct(
        Context $context,
        private readonly FaqFactory $faqFactory,
        private readonly FaqResource $resource
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        // TODO: Implement execute() method.
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->faqFactory->create();

            if (empty($data['faq_id'])) {
                $data['faq_id'] = null;
            }

            $data['status'] = 'Answered';

            if (empty($data['answer'])) {
                $data['status'] = 'Pending';
                $data['position'] = 0;
            }

            if(empty($data['position'])){
                switch($data['status']){
                    case 'Answered':
                        $data['position'] = 1;
                        break;
                    case 'Pending':
                        $data['position'] = 0;
                }
            }

            $model->setData($data);

            try {
                $this->resource->save($model);
                $this->messageManager->addSuccessMessage(__("Faq saved"));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $exception) {
                $this->messageManager->addExceptionMessage($exception);
            } catch (Throwable $e) {
                $this->messageManager->addErrorMessage($e);
            }
        }


        return $resultRedirect->setPath('*/*/');
    }
}

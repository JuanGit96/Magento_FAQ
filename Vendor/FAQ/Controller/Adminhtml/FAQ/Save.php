<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Controller\Adminhtml\FAQ;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Vendor\FAQ\Model\FAQ as Model;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var DataPersistorInterface
     */
    protected DataPersistorInterface $dataPersistor;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param Model $model
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        Model $model
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->model = $model;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('faq_id');
            $this->model->load($id);
            if (!$this->model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Faq no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $this->model->setData($data);

            try {
                $this->model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Faq.'));
                $this->dataPersistor->clear('vendor_faq_faq');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['faq_id' => $this->model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Faq.'));
            }

            $this->dataPersistor->set('vendor_faq_faq', $data);
            return $resultRedirect->setPath('*/*/edit', ['faq_id' => $this->getRequest()->getParam('faq_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}


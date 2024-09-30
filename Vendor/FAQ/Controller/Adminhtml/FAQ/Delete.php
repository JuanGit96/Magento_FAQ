<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Controller\Adminhtml\FAQ;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Vendor\FAQ\Model\FAQ as Model;

class Delete extends \Vendor\FAQ\Controller\Adminhtml\FAQ
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param Model $model
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        Model $model
    )
    {
        parent::__construct($context, $coreRegistry);
        $this->model = $model;
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('faq_id');
        if ($id) {
            try {
                // init model and delete
                $this->model->load($id);
                $this->model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Faq.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['faq_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Faq to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}


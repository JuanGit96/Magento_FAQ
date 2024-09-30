<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Controller\Adminhtml\FAQ;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Vendor\FAQ\Model\FAQ as Model;

class Edit extends \Vendor\FAQ\Controller\Adminhtml\FAQ
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param Model $model
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        Model $model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->model = $model;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('faq_id');

        // 2. Initial checking
        if ($id) {
            $this->model->load($id);
            if (!$this->model->getId()) {
                $this->messageManager->addErrorMessage(__('This Faq no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('vendor_faq_faq', $this->model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Faq') : __('New Faq'),
            $id ? __('Edit Faq') : __('New Faq')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Faqs'));
        $resultPage->getConfig()->getTitle()->prepend($this->model->getId() ? __('Edit Faq %1', $this->model->getId()) : __('New Faq'));
        return $resultPage;
    }
}


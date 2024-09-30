<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Controller\Adminhtml\FAQ;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Vendor\FAQ\Model\FAQ as Model;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var JsonFactory
     */
    protected JsonFactory $jsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param Model $model
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        Model $model
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->model = $model;
    }

    /**
     * Inline edit action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    try {
                        $this->model->setData(
                            array_merge($this->model->getData(), $postItems[$modelid])
                        );
                        $this->model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Faq ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}


<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;

abstract class FAQ extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Vendor_FAQ::top_level';

    /**
     * @var Registry
     */
    protected Registry $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage($resultPage)
    {
        $resultPage
            ->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Vendor'), __('Vendor'))
            ->addBreadcrumb(__('Faq'), __('Faq'));
        return $resultPage;
    }
}


<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Block\Index;

use Magento\Framework\View\Element\Template\Context;
use Vendor\FAQ\Model\ResourceModel\FAQ\CollectionFactory;

class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($context, $data);
    }

    public function getFAQ()
    {
        return $this->collection
            ->addFieldToFilter('status', ['eq' => 1])
            ->setOrder('sort_order', 'ASC')
            ->getItems();
    }
}


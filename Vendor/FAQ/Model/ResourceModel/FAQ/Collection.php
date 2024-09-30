<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Model\ResourceModel\FAQ;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vendor\FAQ\Model\FAQ as FAQModel;
use Vendor\FAQ\Model\ResourceModel\FAQ as FAQResourceModel;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'faq_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            FAQModel::class,
            FAQResourceModel::class
        );
    }
}


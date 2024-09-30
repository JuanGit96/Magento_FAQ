<?php

namespace Vendor\FAQ\Block\Adminhtml\System\Config;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template\Context;
use Vendor\FAQ\Model\ResourceModel\FAQ\CollectionFactory;

class FAQTable extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_template = 'Vendor_FAQ::system/config/faq_table.phtml';

    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    /**
     * @return mixed
     */
    public function getFaqCollection()
    {
        return $this->collectionFactory->create()
            ->addFieldToFilter('status', 1)
            ->setOrder('sort_order', 'ASC');
    }
}

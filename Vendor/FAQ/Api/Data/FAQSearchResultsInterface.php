<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Api\Data;

interface FAQSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get FAQ list.
     * @return \Vendor\FAQ\Api\Data\FAQInterface[]
     */
    public function getItems();

    /**
     * Set question list.
     * @param \Vendor\FAQ\Api\Data\FAQInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}


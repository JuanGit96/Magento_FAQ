<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FAQRepositoryInterface
{

    /**
     * Save FAQ
     * @param \Vendor\FAQ\Api\Data\FAQInterface $fAQ
     * @return \Vendor\FAQ\Api\Data\FAQInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Vendor\FAQ\Api\Data\FAQInterface $fAQ);

    /**
     * Retrieve FAQ
     * @param string $faqId
     * @return \Vendor\FAQ\Api\Data\FAQInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($faqId);

    /**
     * Retrieve FAQ matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vendor\FAQ\Api\Data\FAQSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete FAQ
     * @param \Vendor\FAQ\Api\Data\FAQInterface $fAQ
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Vendor\FAQ\Api\Data\FAQInterface $fAQ);

    /**
     * Delete FAQ by ID
     * @param string $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);
}


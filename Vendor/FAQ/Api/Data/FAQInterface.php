<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Api\Data;

interface FAQInterface
{

    const SORT_ORDER = 'sort_order';
    const STATUS = 'status';
    const FAQ_ID = 'faq_id';
    const QUESTION = 'question';
    const ANSWER = 'answer';

    /**
     * Get faq_id
     * @return string|null
     */
    public function getFaqId();

    /**
     * Set faq_id
     * @param string $faqId
     * @return \Vendor\FAQ\FAQ\Api\Data\FAQInterface
     */
    public function setFaqId($faqId);

    /**
     * Get question
     * @return string|null
     */
    public function getQuestion();

    /**
     * Set question
     * @param string $question
     * @return \Vendor\FAQ\FAQ\Api\Data\FAQInterface
     */
    public function setQuestion($question);

    /**
     * Get answer
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set answer
     * @param string $answer
     * @return \Vendor\FAQ\FAQ\Api\Data\FAQInterface
     */
    public function setAnswer($answer);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Vendor\FAQ\FAQ\Api\Data\FAQInterface
     */
    public function setStatus($status);

    /**
     * Get sort_order
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Set sort_order
     * @param string $sortOrder
     * @return \Vendor\FAQ\FAQ\Api\Data\FAQInterface
     */
    public function setSortOrder($sortOrder);
}


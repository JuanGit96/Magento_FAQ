<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\FAQ\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vendor\FAQ\Api\Data\FAQInterface;
use Vendor\FAQ\Api\Data\FAQInterfaceFactory;
use Vendor\FAQ\Api\Data\FAQSearchResultsInterfaceFactory;
use Vendor\FAQ\Api\FAQRepositoryInterface;
use Vendor\FAQ\Model\ResourceModel\FAQ as ResourceFAQ;
use Vendor\FAQ\Model\ResourceModel\FAQ\CollectionFactory as FAQCollectionFactory;

class FAQRepository implements FAQRepositoryInterface
{

    /**
     * @var FAQCollectionFactory
     */
    protected $fAQCollectionFactory;

    /**
     * @var ResourceFAQ
     */
    protected $resource;

    /**
     * @var FAQInterfaceFactory
     */
    protected $fAQFactory;

    /**
     * @var FAQ
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceFAQ $resource
     * @param FAQInterfaceFactory $fAQFactory
     * @param FAQCollectionFactory $fAQCollectionFactory
     * @param FAQSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceFAQ $resource,
        FAQInterfaceFactory $fAQFactory,
        FAQCollectionFactory $fAQCollectionFactory,
        FAQSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->fAQFactory = $fAQFactory;
        $this->fAQCollectionFactory = $fAQCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(FAQInterface $fAQ)
    {
        try {
            $this->resource->save($fAQ);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the fAQ: %1',
                $exception->getMessage()
            ));
        }
        return $fAQ;
    }

    /**
     * @inheritDoc
     */
    public function get($fAQId)
    {
        $fAQ = $this->fAQFactory->create();
        $this->resource->load($fAQ, $fAQId);
        if (!$fAQ->getId()) {
            throw new NoSuchEntityException(__('FAQ with id "%1" does not exist.', $fAQId));
        }
        return $fAQ;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->fAQCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(FAQInterface $fAQ)
    {
        try {
            $fAQModel = $this->fAQFactory->create();
            $this->resource->load($fAQModel, $fAQ->getFaqId());
            $this->resource->delete($fAQModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the FAQ: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($fAQId)
    {
        return $this->delete($this->get($fAQId));
    }
}


<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListCustomerGroupRepository implements \Dealer4dealer\Xcore\Api\PriceListCustomerGroupRepositoryInterface
{
    protected $logger;
    protected $priceListCustomerGroupFactory;
    protected $priceListCustomerGroupCollectionFactory;
    protected $searchResultsFactory;
    protected $priceListRepository;
    protected $customerGroupRepository;

    /**
     * @param \Psr\Log\LoggerInterface                                                                                                    $logger
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface|\Magento\Framework\App\Config\BaseFactory                     $priceListCustomerGroupFactory
     * @param \Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroup\CollectionFactory|\Magento\Framework\App\Config\BaseFactory $priceListCustomerGroupCollectionFactory
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupSearchResultsInterface|\Magento\Framework\App\Config\BaseFactory        $searchResultsFactory
     * @param \Dealer4dealer\Xcore\Api\PriceListRepositoryInterface                                                                       $priceListRepository
     * @param \Dealer4dealer\Xcore\Api\PriceListRepositoryInterface                                                                       $priceListRepository
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterfaceFactory $priceListCustomerGroupFactory,
        \Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroup\CollectionFactory $priceListCustomerGroupCollectionFactory,
        \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupSearchResultsInterfaceFactory $searchResultsFactory,
        \Dealer4dealer\Xcore\Api\PriceListRepositoryInterface $priceListRepository,
        \Magento\Customer\Api\GroupRepositoryInterface $customerGroupRepository
    ) {
        $this->logger                                  = $logger;
        $this->priceListCustomerGroupFactory           = $priceListCustomerGroupFactory;
        $this->priceListCustomerGroupCollectionFactory = $priceListCustomerGroupCollectionFactory;
        $this->searchResultsFactory                    = $searchResultsFactory;
        $this->priceListRepository                     = $priceListRepository;
        $this->customerGroupRepository                 = $customerGroupRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface $priceListCustomerGroup)
    {
        try {
            /** @var PriceListCustomerGroup $priceListCustomerGroup */
            $priceListCustomerGroup->getResource()->save($priceListCustomerGroup);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __(sprintf('Could not save the Price List: %s', $exception->getMessage()))
            );
        }
        return $priceListCustomerGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($priceListCustomerGroupId)
    {
        /** @var PriceList $priceListCustomerGroup */
        $priceListCustomerGroup = $this->priceListCustomerGroupFactory->create();
        $priceListCustomerGroup->getResource()->load($priceListCustomerGroup, $priceListCustomerGroupId);
        if (!$priceListCustomerGroup->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(
                __(sprintf('Price List with id %s does not exist', $priceListCustomerGroupId))
            );
        }

        return $priceListCustomerGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Dealer4dealer\Xcore\Model\ResourceModel\PriceList\Collection $collection */
        $collection = $this->priceListCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
//                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var \Magento\Framework\Api\SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == \Magento\Framework\Api\SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        /** @var \Dealer4dealer\Xcore\Api\Data\PriceListSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList)
    {
        try {
            /** @var PriceList $priceList */
            $priceList->getResource()->delete($priceList);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __(sprintf('Could not delete the Price List: %s', $exception->getMessage()))
            );
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($priceListId)
    {
        return $this->delete($this->getById($priceListId));
    }

    /**
     * {@inheritdoc}
     */
    public function getJsonList()
    {
        /** @var \Dealer4dealer\Xcore\Model\ResourceModel\PriceList\Collection $collection */
        $collection = $this->getList(new \Magento\Framework\Api\SearchCriteria());

        $result = [];

        /** @var \Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList */
        foreach ($collection->getItems() as $priceList) {
//            $priceList->setItems($this->priceListItemRepository->getByPriceListId($priceList->getId()));

            $result[] = $priceList;
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getJsonById($id, $withItems = true)
    {
        /** @var PriceList $priceList */
        $priceList = $this->priceListFactory->create();
        $priceList->getResource()->load($priceList, $id);
        if (!$priceList->getId()) {
            return null;
        }

        if ($withItems) {
            $priceList->setItems($this->priceListItemRepository->getByPriceListId($priceList->getId()));
        }

        return $priceList;
    }

    /**
     * {@inheritdoc}
     */
    public function getJsonByGuid($guid, $withItems = true)
    {
        /** @var PriceList $priceList */
        $priceList = $this->priceListFactory->create();
        $priceList->getResource()->load($priceList, $guid, 'guid');
        if (!$priceList->getGuid()) {
            return null;
        }

        if ($withItems) {
            $priceList->setItems($this->priceListItemRepository->getByPriceListId($priceList->getId()));
        }

        return $priceList;
    }

    /**
     * {@inheritdoc}
     */
    public function saveJson(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $price_list)
    {
        $priceList = $this->getOrSavePriceList($price_list);

        if ($price_list->getItems()) {
            /** @var \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[] $items */
            $items = [];

            /** @var \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $item */
            foreach ($price_list->getItems() as $item) {
                $addedItem = $this->getOrSavePriceListItem($priceList->getId(), $item);
                if ($addedItem) {
                    $items[] = $addedItem;
                }
            }

            $priceList->setItems($items);
        }

        return $priceList;
    }

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $newPriceList
     * @return PriceList
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    private function getOrSavePriceList(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $newPriceList)
    {
        /** @var PriceList $priceList */
        $priceList = $this->priceListFactory->create();
        $priceList->getResource()->load($priceList, $newPriceList->getGuid(), 'guid');

        $priceList->setGuid($newPriceList->getGuid());
        $priceList->setCode($newPriceList->getCode());

        $priceList->getResource()->save($priceList);

        return $priceList;
    }

    /**
     * @param int                                                  $priceListId
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $item
     * @return PriceListItem
     */
    private function getOrSavePriceListItem($priceListId, \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $item)
    {
        try {
            /** @var PriceListItem $priceListItem */
            $priceListItem = $this->priceListItemRepository->getUniqueRow(
                $item->getProductSku(),
                $item->getQty(),
                $priceListId
            );

            // Set the guid and code (overwrite code if previous price list existed)
            $priceListItem->setPriceListId($priceListId);
            $priceListItem->setProductSku($item->getProductSku());
            $priceListItem->setQty($item->getQty());
            $priceListItem->setPrice($item->getPrice());
            $priceListItem->setStartDate($item->getStartDate());
            $priceListItem->setEndDate($item->getEndDate());
            $priceListItem->setProcessed(0);
            $priceListItem->setErrorCount(0);

            $priceListItem->getResource()->save($priceListItem);

            return $priceListItem;
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('Failed to get or save price list item: %s', $exception->getMessage()));
        }
    }
}

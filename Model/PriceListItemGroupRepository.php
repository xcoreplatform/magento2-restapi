<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListItemGroupRepository implements \Dealer4dealer\Xcore\Api\PriceListItemGroupRepositoryInterface
{
    protected $priceListItemGroupFactory;
    protected $priceListItemGroupCollectionFactory;
    protected $searchResultsFactory;
    protected $searchCriteriaBuilder;

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterfaceFactory|\Magento\Framework\App\Config\BaseFactory              $priceListItemGroupFactory
     * @param \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItemGroup\CollectionFactory|\Magento\Framework\App\Config\BaseFactory $priceListItemGroupCollectionFactory
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupSearchResultsInterfaceFactory|\Magento\Framework\App\Config\BaseFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteriaBuilder                                                                            $searchCriteriaBuilder
     */
    public function __construct(
        \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterfaceFactory $priceListItemGroupFactory,
        \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItemGroup\CollectionFactory $priceListItemGroupCollectionFactory,
        \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->priceListItemGroupFactory           = $priceListItemGroupFactory;
        $this->priceListItemGroupCollectionFactory = $priceListItemGroupCollectionFactory;
        $this->searchResultsFactory                = $searchResultsFactory;
        $this->searchCriteriaBuilder               = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface $priceListItemGroup)
    {
        try {
            /** @var PriceListItemGroup $priceListItemGroup */
            $priceListItemGroup->getResource()->save($priceListItemGroup);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __(sprintf('Could not save the Price List Item Group: %s', $exception->getMessage()))
            );
        }
        return $priceListItemGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($priceListItemGroupId)
    {
        /** @var PriceListItem $priceListItemGroup */
        $priceListItemGroup = $this->priceListItemGroupFactory->create();
        $priceListItemGroup->getResource()->load($priceListItemGroup, $priceListItemGroupId);
        if (!$priceListItemGroup->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(
                __(sprintf('Price List Item Group with id %s does not exist', $priceListItemGroupId))
            );
        }
        return $priceListItemGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Dealer4dealer\Xcore\Model\ResourceModel\PriceList\Collection $collection */
        $collection = $this->priceListItemGroupCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
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

        /** @var \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface $priceListItemGroup)
    {
        try {
            /** @var PriceListItemGroup $priceListItemGroup */
            $priceListItemGroup->getResource()->delete($priceListItemGroup);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __(sprintf('Could not delete the price_list_item_group: %s', $exception->getMessage()))
            );
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($priceListItemGroupId)
    {
        return $this->delete($this->getById($priceListItemGroupId));
    }

    /**
     * Returns a price list item if found, otherwise an "empty" record.
     *
     * @param      $itemGroupCode
     * @param      $qty
     * @param null $priceListId
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface|\Magento\Framework\App\Config\Base
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getUniqueRow($itemGroup, $qty, $priceListId = null)
    {
        $searchCriteria      = $this->searchCriteriaBuilder->setFilterGroups([])
                                                           ->addFilter('price_list_id', $priceListId)
                                                           ->addFilter('item_group', $itemGroup)
                                                           ->addFilter('qty', $qty)
                                                           ->create();
        $itemGroupCollection = $this->getList($searchCriteria);

        foreach ($itemGroupCollection->getItems() as $item) return $item;

        return $this->priceListItemGroupFactory->create();
    }

    /**
     * Returns the price list item groups that belong to a specific price list.
     *
     * @param int $priceListId
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByPriceListId($priceListId)
    {
        $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups([])
                                                      ->addFilter('price_list_id', $priceListId)
                                                      ->create();
        $itemCollection = $this->getList($searchCriteria);

        return $itemCollection->getItems();
    }
}

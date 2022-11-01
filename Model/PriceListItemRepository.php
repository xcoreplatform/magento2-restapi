<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListItemRepository implements \Dealer4dealer\Xcore\Api\PriceListItemRepositoryInterface
{
    protected $priceListItemFactory;
    protected $priceListItemCollectionFactory;
    protected $searchResultsFactory;
    protected $searchCriteriaBuilder;

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterfaceFactory|\Magento\Framework\App\Config\BaseFactory              $priceListItemFactory
     * @param \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem\CollectionFactory|\Magento\Framework\App\Config\BaseFactory $priceListItemCollectionFactory
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterfaceFactory|\Magento\Framework\App\Config\BaseFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteriaBuilder                                                                       $searchCriteriaBuilder
     */
    public function __construct(
        \Dealer4dealer\Xcore\Api\Data\PriceListItemInterfaceFactory $priceListItemFactory,
        \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem\CollectionFactory $priceListItemCollectionFactory,
        \Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->priceListItemFactory           = $priceListItemFactory;
        $this->priceListItemCollectionFactory = $priceListItemCollectionFactory;
        $this->searchResultsFactory           = $searchResultsFactory;
        $this->searchCriteriaBuilder          = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem)
    {
        try {
            /** @var PriceListItem $priceListItem */
            $priceListItem->getResource()->save($priceListItem);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __(sprintf('Could not save the Price List Item: %s', $exception->getMessage()))
            );
        }
        return $priceListItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($priceListItemId)
    {
        /** @var PriceListItem $priceListItem */
        $priceListItem = $this->priceListItemFactory->create();
        $priceListItem->getResource()->load($priceListItem, $priceListItemId);
        if (!$priceListItem->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__(sprintf('Price List Item with id %s does not exist', $priceListItemId)));
        }
        return $priceListItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Dealer4dealer\Xcore\Model\ResourceModel\PriceList\Collection $collection */
        $collection = $this->priceListItemCollectionFactory->create();
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

        /** @var \Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem)
    {
        try {
            /** @var PriceListItem $priceListItem */
            $priceListItem->getResource()->delete($priceListItem);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __(sprintf('Could not delete the price_list_item: %s', $exception->getMessage()))
            );
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($priceListItemId)
    {
        return $this->delete($this->getById($priceListItemId));
    }

    /**
     * Returns a price list item if found, otherwise an "empty" record.
     *
     * @param      $productSku
     * @param      $qty
     * @param null $priceListId
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface|\Magento\Framework\App\Config\Base
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getUniqueRow($productSku, $qty, $priceListId = null)
    {
        $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups([])
                                                      ->addFilter('price_list_id', $priceListId)
                                                      ->addFilter('product_sku', $productSku)
                                                      ->addFilter('qty', $qty)
                                                      ->create();
        $itemCollection = $this->getList($searchCriteria);

        foreach ($itemCollection->getItems() as $item) {
            return $item;
        }

        return $this->priceListItemFactory->create();
    }

    /**
     * Returns the price list items that belong to a specific price list.
     *
     * @param int $priceListId
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[]
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

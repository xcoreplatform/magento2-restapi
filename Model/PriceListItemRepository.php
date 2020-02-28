<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListItemInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListItemInterfaceFactory;
use Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterfaceFactory;
use Dealer4dealer\Xcore\Api\PriceListItemRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceList\Collection;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem\CollectionFactory as PriceListItemCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\App\Config\BaseFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class PriceListItemRepository implements PriceListItemRepositoryInterface
{
    protected $priceListItemFactory;
    protected $priceListItemCollectionFactory;
    protected $searchResultsFactory;
    protected $searchCriteriaBuilder;

    /**
     * @param PriceListItemFactory|BaseFactory                       $priceListItemFactory
     * @param PriceListItemCollectionFactory|BaseFactory             $priceListItemCollectionFactory
     * @param PriceListItemSearchResultsInterfaceFactory|BaseFactory $searchResultsFactory
     *
     * @param SearchCriteriaBuilder                                  $searchCriteriaBuilder
     */
    public function __construct(
        PriceListItemFactory $priceListItemFactory,
        PriceListItemCollectionFactory $priceListItemCollectionFactory,
        PriceListItemSearchResultsInterfaceFactory $searchResultsFactory,

        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->priceListItemFactory           = $priceListItemFactory;
        $this->priceListItemCollectionFactory = $priceListItemCollectionFactory;
        $this->searchResultsFactory           = $searchResultsFactory;

        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(PriceListItemInterface $priceListItem)
    {
        try {
            /** @var PriceListItem $priceListItem */
            $priceListItem->getResource()->save($priceListItem);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(sprintf('Could not save the Price List Item: %s', $exception->getMessage())));
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
            throw new NoSuchEntityException(__(sprintf('Price List Item with id %s does not exist', $priceListItemId)));
        }
        return $priceListItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var Collection $collection */
        $collection = $this->priceListItemCollectionFactory->create();
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
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        /** @var PriceListItemSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(PriceListItemInterface $priceListItem)
    {
        try {
            /** @var PriceListItem $priceListItem */
            $priceListItem->getResource()->delete($priceListItem);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(sprintf('Could not delete the price_list_item: %s', $exception->getMessage())));
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
     */
    public function getUniqueRow($priceListId = null, $productSku, $qty)
    {
        $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups([])
                                                      ->addFilter('price_list_id', $priceListId)
                                                      ->addFilter('product_sku', $productSku)
                                                      ->addFilter('qty', $qty)
                                                      ->create();
        $itemCollection = $this->getList($searchCriteria);

        foreach ($itemCollection->getItems() as $item) return $item;

        return $this->priceListItemFactory->create();
    }

    /**
     * Returns the price list items that belong to a specific price list.
     *
     * @param int $priceListId
     * @return PriceListItemInterface[]
     * @throws LocalizedException
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

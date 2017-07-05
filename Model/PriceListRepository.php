<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListInterfaceFactory;
use Dealer4dealer\Xcore\Api\Data\PriceListSearchResultsInterfaceFactory;
use Dealer4dealer\Xcore\Api\PriceListRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceList as ResourcePriceList;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceList\CollectionFactory as PriceListCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PriceListRepository implements PriceListRepositoryInterface
{

    protected $dataPriceListFactory;

    protected $resource;

    protected $searchResultsFactory;

    private $storeManager;

    protected $priceListCollectionFactory;

    protected $dataObjectHelper;

    protected $priceListFactory;

    protected $dataObjectProcessor;

    protected $searchCriteriaBuilder;


    /**
     * @param ResourcePriceList $resource
     * @param PriceListFactory $priceListFactory
     * @param PriceListInterfaceFactory $dataPriceListFactory
     * @param PriceListCollectionFactory $priceListCollectionFactory
     * @param PriceListSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ResourcePriceList $resource,
        PriceListFactory $priceListFactory,
        PriceListInterfaceFactory $dataPriceListFactory,
        PriceListCollectionFactory $priceListCollectionFactory,
        PriceListSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->resource                   = $resource;
        $this->priceListFactory           = $priceListFactory;
        $this->priceListCollectionFactory = $priceListCollectionFactory;
        $this->searchResultsFactory       = $searchResultsFactory;
        $this->dataObjectHelper           = $dataObjectHelper;
        $this->dataPriceListFactory       = $dataPriceListFactory;
        $this->dataObjectProcessor        = $dataObjectProcessor;
        $this->storeManager               = $storeManager;
        $this->searchCriteriaBuilder      = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        PriceListInterface $priceList
    )
    {
        try {
            $priceList->getResource()->save($priceList);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                                                'Could not save the priceList',
                                                $exception->getMessage()
                                            ));
        }
        return $priceList;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $priceList = $this->priceListFactory->create();
        $priceList->getResource()->load($priceList, $id);
        if (!$priceList->getId()) {
            throw new NoSuchEntityException(__('PriceList does not exist', $id));
        }
        return $priceList;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        SearchCriteriaInterface $criteria
    )
    {
        $collection = $this->priceListCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
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

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        PriceListInterface $priceList
    )
    {
        try {
            $priceList->getResource()->delete($priceList);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                                                  'Could not delete the PriceList',
                                                  $exception->getMessage()
                                              ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByPriceListId($priceListId)
    {

        $searchCriteria = $this->searchCriteriaBuilder->addFilter('price_list_id', $priceListId)->create();

        $collection = $this->getList($searchCriteria);
        $count      = $collection->getTotalCount();

        foreach ($collection->getItems() as $item) {
            $item->delete();
        }

        return $count;
    }
}
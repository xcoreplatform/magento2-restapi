<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterfaceFactory;
use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupSearchResultsInterfaceFactory;
use Dealer4dealer\Xcore\Api\PriceListCustomerGroupRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroup as ResourcePriceListCustomerGroup;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroup\CollectionFactory as PriceListCustomerGroupCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PriceListCustomerGroupRepository implements PriceListCustomerGroupRepositoryInterface
{

    protected $dataPriceListCustomerGroupFactory;

    protected $resource;

    protected $searchResultsFactory;

    private $storeManager;

    protected $priceListCustomerGroupCollectionFactory;

    protected $dataObjectHelper;

    protected $priceListCustomerGroupFactory;

    protected $dataObjectProcessor;

    protected $searchCriteriaBuilder;


    /**
     * @param ResourcePriceListCustomerGroup $resource
     * @param PriceListCustomerGroupFactory $priceListCustomerGroupFactory
     * @param PriceListCustomerGroupInterfaceFactory $dataPriceListCustomerGroupFactory
     * @param PriceListCustomerGroupCollectionFactory $priceListCustomerGroupCollectionFactory
     * @param PriceListCustomerGroupSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ResourcePriceListCustomerGroup $resource,
        PriceListCustomerGroupFactory $priceListCustomerGroupFactory,
        PriceListCustomerGroupInterfaceFactory $dataPriceListCustomerGroupFactory,
        PriceListCustomerGroupCollectionFactory $priceListCustomerGroupCollectionFactory,
        PriceListCustomerGroupSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->resource                                = $resource;
        $this->priceListCustomerGroupFactory           = $priceListCustomerGroupFactory;
        $this->priceListCustomerGroupCollectionFactory = $priceListCustomerGroupCollectionFactory;
        $this->searchResultsFactory                    = $searchResultsFactory;
        $this->dataObjectHelper                        = $dataObjectHelper;
        $this->dataPriceListCustomerGroupFactory       = $dataPriceListCustomerGroupFactory;
        $this->dataObjectProcessor                     = $dataObjectProcessor;
        $this->storeManager                            = $storeManager;
        $this->searchCriteriaBuilder                   = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        PriceListCustomerGroupInterface $priceListCustomerGroup
    )
    {
        try {
            $priceListCustomerGroup->getResource()->save($priceListCustomerGroup);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                                                'Could not save the priceListCustomerGroup: %1',
                                                $exception->getMessage()
                                            ));
        }
        return $priceListCustomerGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $priceListCustomerGroup = $this->priceListCustomerGroupFactory->create();
        $priceListCustomerGroup->getResource()->load($priceListCustomerGroup, $id);
        if (!$priceListCustomerGroup->getId()) {
            throw new NoSuchEntityException(__('PriceListCustomerGroup with id "%1" does not exist.', $id));
        }
        return $priceListCustomerGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        SearchCriteriaInterface $criteria
    )
    {
        $collection = $this->priceListCustomerGroupCollectionFactory->create();
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
        PriceListCustomerGroupInterface $priceListCustomerGroup
    )
    {
        try {
            $priceListCustomerGroup->getResource()->delete($priceListCustomerGroup);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                                                  'Could not delete the PriceListCustomerGroup: %1',
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
    public function deleteByCustomerGroupId($customerGroupId)
    {

        $searchCriteria = $this->searchCriteriaBuilder->addFilter('customer_group_id', $customerGroupId)->create();

        $collection = $this->getList($searchCriteria);
        $count      = $collection->getTotalCount();

        foreach ($collection->getItems() as $item) {
            $item->delete();
        }

        return $count;
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
<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteInterfaceFactory;
use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteSearchResultsInterfaceFactory;
use Dealer4dealer\Xcore\Api\PriceListCustomerGroupWebsiteRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroupWebsite as ResourcePriceListCustomerGroupWebsite;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroupWebsite\CollectionFactory as PriceListCustomerGroupWebsiteCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PriceListCustomerGroupWebsiteRepository implements PriceListCustomerGroupWebsiteRepositoryInterface
{

    protected $dataPriceListCustomerGroupWebsiteFactory;

    protected $resource;

    protected $searchResultsFactory;

    private $storeManager;

    protected $priceListCustomerGroupWebsiteCollectionFactory;

    protected $dataObjectHelper;

    protected $priceListCustomerGroupWebsiteFactory;

    protected $dataObjectProcessor;

    protected $searchCriteriaBuilder;


    /**
     * @param ResourcePriceListCustomerGroupWebsite $resource
     * @param PriceListCustomerGroupWebsiteFactory $priceListCustomerGroupWebsiteFactory
     * @param PriceListCustomerGroupWebsiteInterfaceFactory $dataPriceListCustomerGroupWebsiteFactory
     * @param PriceListCustomerGroupWebsiteCollectionFactory $priceListCustomerGroupWebsiteCollectionFactory
     * @param PriceListCustomerGroupWebsiteSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ResourcePriceListCustomerGroupWebsite $resource,
        PriceListCustomerGroupWebsiteFactory $priceListCustomerGroupWebsiteFactory,
        PriceListCustomerGroupWebsiteInterfaceFactory $dataPriceListCustomerGroupWebsiteFactory,
        PriceListCustomerGroupWebsiteCollectionFactory $priceListCustomerGroupWebsiteCollectionFactory,
        PriceListCustomerGroupWebsiteSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->resource                                       = $resource;
        $this->priceListCustomerGroupWebsiteFactory           = $priceListCustomerGroupWebsiteFactory;
        $this->priceListCustomerGroupWebsiteCollectionFactory = $priceListCustomerGroupWebsiteCollectionFactory;
        $this->searchResultsFactory                           = $searchResultsFactory;
        $this->dataObjectHelper                               = $dataObjectHelper;
        $this->dataPriceListCustomerGroupWebsiteFactory       = $dataPriceListCustomerGroupWebsiteFactory;
        $this->dataObjectProcessor                            = $dataObjectProcessor;
        $this->storeManager                                   = $storeManager;
        $this->searchCriteriaBuilder                          = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        PriceListCustomerGroupWebsiteInterface $priceListCustomerGroupWebsite
    )
    {
        try {
            $priceListCustomerGroupWebsite->getResource()->save($priceListCustomerGroupWebsite);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                                                'Could not save the priceListCustomerGroupWebsite',
                                                $exception->getMessage()
                                            ));
        }
        return $priceListCustomerGroupWebsite;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $priceListCustomerGroupWebsite = $this->priceListCustomerGroupWebsiteFactory->create();
        $priceListCustomerGroupWebsite->getResource()->load($priceListCustomerGroupWebsite, $id);
        if (!$priceListCustomerGroupWebsite->getId()) {
            throw new NoSuchEntityException(__('PriceListCustomerGroupWebsite does not exist', $id));
        }
        return $priceListCustomerGroupWebsite;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        SearchCriteriaInterface $criteria
    )
    {
        $collection = $this->priceListCustomerGroupWebsiteCollectionFactory->create();
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
        PriceListCustomerGroupWebsiteInterface $priceListCustomerGroupWebsite
    )
    {
        try {
            $priceListCustomerGroupWebsite->getResource()->delete($priceListCustomerGroupWebsite);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                                                  'Could not delete the PriceListCustomerGroupWebsite',
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
}
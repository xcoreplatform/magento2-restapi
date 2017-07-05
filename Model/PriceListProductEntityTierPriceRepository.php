<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListProductEntityTierPriceInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListProductEntityTierPriceInterfaceFactory;
use Dealer4dealer\Xcore\Api\Data\PriceListProductEntityTierPriceSearchResultsInterfaceFactory;
use Dealer4dealer\Xcore\Api\PriceListProductEntityTierPriceRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListProductEntityTierPrice as ResourcePriceListProductEntityTierPrice;
use Dealer4dealer\Xcore\Model\ResourceModel\PriceListProductEntityTierPrice\CollectionFactory as PriceListProductEntityTierPriceCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PriceListProductEntityTierPriceRepository implements PriceListProductEntityTierPriceRepositoryInterface
{

    protected $dataPriceListProductEntityTierPriceFactory;

    protected $resource;

    protected $searchResultsFactory;

    private $storeManager;

    protected $priceListProductEntityTierPriceCollectionFactory;

    protected $dataObjectHelper;

    protected $priceListProductEntityTierPriceFactory;

    protected $dataObjectProcessor;

    protected $searchCriteriaBuilder;


    /**
     * @param ResourcePriceListProductEntityTierPrice $resource
     * @param PriceListProductEntityTierPriceFactory $priceListProductEntityTierPriceFactory
     * @param PriceListProductEntityTierPriceInterfaceFactory $dataPriceListProductEntityTierPriceFactory
     * @param PriceListProductEntityTierPriceCollectionFactory $priceListProductEntityTierPriceCollectionFactory
     * @param PriceListProductEntityTierPriceSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ResourcePriceListProductEntityTierPrice $resource,
        PriceListProductEntityTierPriceFactory $priceListProductEntityTierPriceFactory,
        PriceListProductEntityTierPriceInterfaceFactory $dataPriceListProductEntityTierPriceFactory,
        PriceListProductEntityTierPriceCollectionFactory $priceListProductEntityTierPriceCollectionFactory,
        PriceListProductEntityTierPriceSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->resource                                         = $resource;
        $this->priceListProductEntityTierPriceFactory           = $priceListProductEntityTierPriceFactory;
        $this->priceListProductEntityTierPriceCollectionFactory = $priceListProductEntityTierPriceCollectionFactory;
        $this->searchResultsFactory                             = $searchResultsFactory;
        $this->dataObjectHelper                                 = $dataObjectHelper;
        $this->dataPriceListProductEntityTierPriceFactory       = $dataPriceListProductEntityTierPriceFactory;
        $this->dataObjectProcessor                              = $dataObjectProcessor;
        $this->storeManager                                     = $storeManager;
        $this->searchCriteriaBuilder                            = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        PriceListProductEntityTierPriceInterface $priceListProductEntityTierPrice
    )
    {
        try {
            $priceListProductEntityTierPrice->getResource()->save($priceListProductEntityTierPrice);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                                                'Could not save the priceListProductEntityTierPrice',
                                                $exception->getMessage()
                                            ));
        }
        return $priceListProductEntityTierPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $priceListProductEntityTierPrice = $this->priceListProductEntityTierPriceFactory->create();
        $priceListProductEntityTierPrice->getResource()->load($priceListProductEntityTierPrice, $id);
        if (!$priceListProductEntityTierPrice->getId()) {
            throw new NoSuchEntityException(__('PriceListProductEntityTierPrice does not exist', $id));
        }
        return $priceListProductEntityTierPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        SearchCriteriaInterface $criteria
    )
    {
        $collection = $this->priceListProductEntityTierPriceCollectionFactory->create();
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
        PriceListProductEntityTierPriceInterface $priceListProductEntityTierPrice
    )
    {
        try {
            $priceListProductEntityTierPrice->getResource()->delete($priceListProductEntityTierPrice);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                                                  'Could not delete the PriceListProductEntityTierPrice',
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
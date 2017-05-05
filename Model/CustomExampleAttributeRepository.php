<?php


namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Dealer4dealer\Xcore\Model\ResourceModel\CustomExampleAttribute as ResourceCustomExampleAttribute;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SortOrder;
use Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeSearchResultsInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Dealer4dealer\Xcore\Api\CustomExampleAttributeRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\CustomExampleAttribute\CollectionFactory as CustomExampleAttributeCollectionFactory;

class CustomExampleAttributeRepository implements CustomExampleAttributeRepositoryInterface
{

    protected $CustomExampleAttributeCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $dataCustomExampleAttributeFactory;

    protected $CustomExampleAttributeFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $resource;


    /**
     * @param ResourceCustomExampleAttribute $resource
     * @param CustomExampleAttributeFactory $customExampleAttributeFactory
     * @param CustomExampleAttributeInterfaceFactory $dataCustomExampleAttributeFactory
     * @param CustomExampleAttributeCollectionFactory $customExampleAttributeCollectionFactory
     * @param CustomExampleAttributeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceCustomExampleAttribute $resource,
        CustomExampleAttributeFactory $customExampleAttributeFactory,
        CustomExampleAttributeInterfaceFactory $dataCustomExampleAttributeFactory,
        CustomExampleAttributeCollectionFactory $customExampleAttributeCollectionFactory,
        CustomExampleAttributeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->customExampleAttributeFactory = $customExampleAttributeFactory;
        $this->customExampleAttributeCollectionFactory = $customExampleAttributeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomExampleAttributeFactory = $dataCustomExampleAttributeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface $customExampleAttribute
    ) {
        /* if (empty($customExampleAttribute->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customExampleAttribute->setStoreId($storeId);
        } */
        try {
            $this->resource->save($customExampleAttribute);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customExampleAttribute: %1',
                $exception->getMessage()
            ));
        }
        return $customExampleAttribute;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($customExampleAttributeId)
    {
        $customExampleAttribute = $this->customExampleAttributeFactory->create();
        $customExampleAttribute->load($customExampleAttributeId);
        if (!$customExampleAttribute->getId()) {
            throw new NoSuchEntityException(__('CustomExampleAttribute with id "%1" does not exist.', $customExampleAttributeId));
        }
        return $customExampleAttribute;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->customExampleAttributeCollectionFactory->create();
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
        $searchResults->setTotalCount($collection->getSize());
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
        $items = [];
        
        foreach ($collection as $customExampleAttributeModel) {
            $customExampleAttributeData = $this->dataCustomExampleAttributeFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $customExampleAttributeData,
                $customExampleAttributeModel->getData(),
                'Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $customExampleAttributeData,
                'Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface $customExampleAttribute
    ) {
        try {
            $this->resource->delete($customExampleAttribute);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomExampleAttribute: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customExampleAttributeId)
    {
        return $this->delete($this->getById($customExampleAttributeId));
    }
}

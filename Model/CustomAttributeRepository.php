<?php


namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\CustomAttributeInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute as ResourceCustomAttribute;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SortOrder;
use Dealer4dealer\Xcore\Api\Data\CustomAttributeSearchResultsInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Dealer4dealer\Xcore\Api\CustomAttributeRepositoryInterface;
use Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute\CollectionFactory as CustomAttributeCollectionFactory;

class CustomAttributeRepository implements CustomAttributeRepositoryInterface
{

    protected $CustomAttributeCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $dataCustomAttributeFactory;

    protected $CustomAttributeFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $resource;


    /**
     * @param ResourceCustomAttribute $resource
     * @param CustomAttributeFactory $customAttributeFactory
     * @param CustomAttributeInterfaceFactory $dataCustomAttributeFactory
     * @param CustomAttributeCollectionFactory $customAttributeCollectionFactory
     * @param CustomAttributeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceCustomAttribute $resource,
        CustomAttributeFactory $customAttributeFactory,
        CustomAttributeInterfaceFactory $dataCustomAttributeFactory,
        CustomAttributeCollectionFactory $customAttributeCollectionFactory,
        CustomAttributeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->customAttributeFactory = $customAttributeFactory;
        $this->customAttributeCollectionFactory = $customAttributeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomAttributeFactory = $dataCustomAttributeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface $customAttribute
    ) {
        /* if (empty($customAttribute->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customAttribute->setStoreId($storeId);
        } */
        try {
            $this->resource->save($customAttribute);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customAttribute: %1',
                $exception->getMessage()
            ));
        }
        return $customAttribute;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($customAttributeId)
    {
        $customAttribute = $this->customAttributeFactory->create();
        $customAttribute->load($customAttributeId);
        if (!$customAttribute->getId()) {
            throw new NoSuchEntityException(__('CustomAttribute with id "%1" does not exist.', $customAttributeId));
        }
        return $customAttribute;
    }

    /**
     * {@inheritdoc}
     */
    public function getListByType($customAttributeType)
    {
        $collection = $this->customAttributeCollectionFactory->create();
        $collection->addFieldToFilter('type', ['eq' => $customAttributeType]);

        $items = [];
        foreach ($collection as $customAttributeModel) {
            $customAttributeData = $this->dataCustomAttributeFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $customAttributeData,
                $customAttributeModel->getData(),
                'Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $customAttributeData,
                'Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface'
            );
        }

        return $items;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->customAttributeCollectionFactory->create();
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

        foreach ($collection as $customAttributeModel) {
            $customAttributeData = $this->dataCustomAttributeFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $customAttributeData,
                $customAttributeModel->getData(),
                'Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $customAttributeData,
                'Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface $customAttribute
    ) {
        try {
            $this->resource->delete($customAttribute);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomAttribute: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customAttributeId)
    {
        return $this->delete($this->getById($customAttributeId));
    }
}

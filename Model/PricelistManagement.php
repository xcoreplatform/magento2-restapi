<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListInterface;
use Dealer4dealer\Xcore\Api\PricelistManagementInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class PricelistManagement implements PricelistManagementInterface
{
    /** @var Context */
    private $_context;
    /** @var Registry */
    private $_registry;
    /** @var SearchCriteriaBuilder */
    private $_searchCriteriaBuilder;
    /** @var PriceListRepository */
    private $_priceListRepository;
    /** @var PriceListCustomerGroupWebsiteRepository */
    private $_customerGroupWebsiteRepository;
    /** @var PriceListProductEntityTierPriceRepository */
    private $_productEntityTierPriceRepository;

    /** @var PriceListData */
    private $data;
    /** @var bool|PriceListInterface */
    private $priceList;
    /** @var PriceListCustomerGroupWebsiteInterface[] */
    private $customerGroupWebsites;

    public function __construct(Context $context,
                                Registry $registry,
                                SearchCriteriaBuilder $searchCriteriaBuilder,
                                PriceListRepository $priceListRepository,
                                PriceListCustomerGroupWebsiteRepository $customerGroupWebsiteRepository,
                                PriceListProductEntityTierPriceRepository $productEntityTierPriceRepository)
    {
        $this->_context                          = $context;
        $this->_registry                         = $registry;
        $this->_searchCriteriaBuilder            = $searchCriteriaBuilder;
        $this->_priceListRepository              = $priceListRepository;
        $this->_customerGroupWebsiteRepository   = $customerGroupWebsiteRepository;
        $this->_productEntityTierPriceRepository = $productEntityTierPriceRepository;
    }

    public function getPricelist()
    {
        return 'Not implemented yet';
    }

    public function postPricelist()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $this->setData($data);
        $this->getOrCreatePriceList();
        $this->getOrCreateCustomerGroupWebsites();
        $this->addProductEntityTierPrices();

        $result = $this->buildResult();

        return json_encode($result);
    }

    /**
     * Sets the PriceListData for further use in this class.
     *
     * @param array $data
     */
    private function setData($data)
    {
        $this->data = new PriceListData;
        $this->data->setBatchNumber($data['batch_number'])
                   ->setPriceListId($data['price_list_id'])
                   ->setStartDate($data['start_date'])
                   ->setEndDate($data['end_date'])
                   ->setCustomerGroupIds($data['customer_group_ids'])
                   ->setWebsiteIds($data['website_ids']);

        foreach ($data['items'] as $item) {
            $newItem = new PriceListTierPrice;
            $newItem->setEntityId($item['entity_id'])
                    ->setQty($item['qty'])
                    ->setValue($item['value']);
            $this->data->addItem($newItem);
        }
    }

    /**
     * If the price list is the first batch (multiple batches for 1 price list),
     * this method will remove the price list first. This will cascade and delete
     * all customer groups, websites and items in the list. Then it will create
     * the price list anew. The price list will be stored in the global private
     * var $this->priceList.
     *
     * If it's not the first batch, it will find the existing price list and store
     * it in the global private var $this->priceList as well.
     */
    private function getOrCreatePriceList()
    {
        if ($this->data->getBatchNumber() == 1) {
            $this->removePriceList();
            $this->priceList = $this->addPriceList();
        } else {
            $searchCriteria  = $this->buildPriceListSearchCriteria();
            $collection      = $this->_priceListRepository->getList($searchCriteria);
            $items           = $collection->getItems();
            $this->priceList = reset($items);
        }
    }

    /**
     * Same as the price list creation, this will get or create all records in the
     * price list customer group website table. There's no need to remove all records
     * on the first batch, as they are already removed due to the cascade on the
     * foreign key of the price_list_id.
     */
    private function getOrCreateCustomerGroupWebsites()
    {
        if ($this->data->getBatchNumber() == 1) {
            $this->customerGroupWebsites = $this->addCustomerGroupWebsites();
        } else {
            $this->customerGroupWebsites = [];
            $searchCriteria              = $this->buildPriceListSearchCriteria();
            $collection                  = $this->_customerGroupWebsiteRepository->getList($searchCriteria);
            $items                       = $collection->getItems();
            foreach ($items as $item) {
                $this->customerGroupWebsites[] = $item;
            }
        }
    }

    /**
     * This method will store all the tier prices in our table.
     */
    private function addProductEntityTierPrices()
    {
        foreach ($this->data->getItems() as $item) {
            $this->addTierPrice($item);
        }
    }

    private function buildResult()
    {
        $result = [];

        $result['price_list'] = [
            'id'            => $this->priceList->getId(),
            'price_list_id' => $this->priceList->getPriceListId(),
            'start_date'    => $this->priceList->getStartDate(),
            'end_date'      => $this->priceList->getEndDate(),
        ];

        $customerGroupWebsites = [];
        foreach ($this->customerGroupWebsites as $customerGroupWebsite) {
            $customerGroupWebsites[] = [
                'id'                => $customerGroupWebsite->getId(),
                'all_groups'        => $customerGroupWebsite->getAllGroups(),
                'customer_group_id' => $customerGroupWebsite->getCustomerGroupId(),
                'website_id'        => $customerGroupWebsite->getWebsiteId(),
            ];
        }
        $result['customer_group_website'] = $customerGroupWebsites;

        $result['added_tier_prices'] = count($this->data->getItems());

        return $result;
    }

    private function removePriceList()
    {
        return $this->_priceListRepository->deleteByPriceListId($this->data->getPriceListId());
    }

    private function addPriceList()
    {
        $priceList = new PriceList($this->_context, $this->_registry);
        $priceList->setPriceListId($this->data->getPriceListId())
                  ->setStartDate($this->data->getStartDate())
                  ->setEndDate($this->data->getEndDate());
        return $this->_priceListRepository->save($priceList);
    }

    private function addCustomerGroupWebsites()
    {
        $result = [];
        foreach ($this->data->getCustomerGroupIds() as $customerGroupId) {
            foreach ($this->data->getWebsiteIds() as $websiteId) {
                $customerGroupWebsite = new PriceListCustomerGroupWebsite($this->_context, $this->_registry);
                $customerGroupWebsite->setPriceListId($this->data->getPriceListId())
                                     ->setAllGroups($this->data->getAllGroups() ? '1' : '0')
                                     ->setCustomerGroupId($customerGroupId)
                                     ->setWebsiteId($websiteId);
                $result[] = $this->_customerGroupWebsiteRepository->save($customerGroupWebsite);
            }
        }
        return $result;
    }

    private function addTierPrice(PriceListTierPrice $item)
    {
        $tierPrice = new PriceListProductEntityTierPrice($this->_context, $this->_registry);
        $tierPrice->setPriceListId($this->data->getPriceListId())
                  ->setProductId($item->getEntityId())
                  ->setQty($item->getQty())
                  ->setValue($item->getValue());
        $this->_productEntityTierPriceRepository->save($tierPrice);
    }

    private function buildPriceListSearchCriteria()
    {
        return $this->_searchCriteriaBuilder->addFilter(PriceList::PRICE_LIST_ID, $this->data->getPriceListId())->create();
    }
}
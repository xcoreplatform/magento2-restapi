<?php

namespace Dealer4dealer\Xcore\Model;

use Exception;
use Magento\Framework\App\ResourceConnection;

class PricelistManagement
{
//    /** @var Context */
//    private $_context;
//    /** @var Registry */
//    private $_registry;
//    /** @var PriceListRepository */
//    private $_priceListRepository;
//    /** @var PriceListCustomerGroupRepository */
//    private $_priceListCustomerGroupRepository;
    /** @var ResourceConnection */
    private $_resourceConnection;

    private $_added;
    private $_customerGroups;
    private $_websites;

    public function __construct(ResourceConnection $resourceConnection)
        /*,
                                        Context $context,
                                        Registry $registry,
                                        PriceListRepository $priceListRepository,
                                        PriceListCustomerGroupRepository $priceListCustomerGroupRepository)
        */
    {
        $this->_resourceConnection = $resourceConnection;
        /*
        $this->_context                          = $context;
        $this->_registry                         = $registry;
        $this->_priceListRepository              = $priceListRepository;
        $this->_priceListCustomerGroupRepository = $priceListCustomerGroupRepository;
        */
    }

    public function getPricelist()
    {
        return 'Not implemented yet';
    }

    public function postPricelist()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $removePrevious  = $data['remove_previous'];
        $customerGroupId = $data['customer_group_ids'];
        $websiteId       = $data['website_ids'];

        if ($removePrevious) {
            foreach ($data['items'] as $item) {
                $this->removeOldTierPrice($item);
            }
        }

        foreach ($data['items'] as $item) {
            $this->addNewTierPrice($item, $customerGroupId, $websiteId);
        }

        $result = [
            'unique_products'      => count($data['items']),
            'total_products_added' => $this->_added,
            'customer_groups'      => $this->_customerGroups,
            'websites'             => $this->_websites,
        ];

        return json_encode($result);
    }

    private function removeOldTierPrice($item)
    {
        $table  = $this->tierPriceTable();
        $delete = 'DELETE FROM';
        $sql    = sprintf("%s %s WHERE entity_id = '%s'", $delete, $table, $item['entity_id']);
        $this->execute($sql);
    }

    private function addNewTierPrice($item, $customerGroupIds, $websiteIds)
    {
        try {

            $allGroups = 1;

            if ($customerGroupIds || $customerGroupIds === "0") {
                $allGroups = 0;
            } else {
                $customerGroupIds = 0;
            }

            if ($websiteIds == null) {
                $websiteIds = 0;
            }

            $this->addNewTierPriceForCustomerGroupsAndWebsites($item, $allGroups, $customerGroupIds, $websiteIds);

        } catch (Exception $e) {

        }
    }

    private function addNewTierPriceForCustomerGroupsAndWebsites($item, $allGroups, $customerGroupIds, $websiteIds)
    {
        $table  = $this->tierPriceTable();
        $insert = 'INSERT INTO';

        $customerGroupIds = explode(',', $customerGroupIds);
        $websiteIds       = explode(',', $websiteIds);


        foreach ($customerGroupIds as $customerGroupId) {
            $this->_customerGroups++;
            foreach ($websiteIds as $websiteId) {
                $this->_websites++;
                $sql = sprintf("%s %s (entity_id, all_groups, customer_group_id, qty, value, website_id) VALUES ('%s','%s','%s','%s','%s','%s')",
                               $insert,
                               $table,
                               $item['entity_id'],
                               $allGroups,
                               $customerGroupId,
                               $item['qty'],
                               $item['price'],
                               $websiteId);
                $this->execute($sql);
                $this->_added++;
            }
        }
    }

    private function execute($sql)
    {
        $this->_resourceConnection->getConnection()->query($sql);
    }

    private function tierPriceTable()
    {
        return $this->_resourceConnection->getConnection()->getTableName('catalog_product_entity_tier_price');
    }
}
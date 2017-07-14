<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteInterface;
use Magento\Framework\Model\AbstractModel;

class PriceListCustomerGroupWebsite extends AbstractModel implements PriceListCustomerGroupWebsiteInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroupWebsite');
    }

    /**
     * Get id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get price_list_id
     * @return string
     */
    public function getPriceListId()
    {
        return $this->getData(self::PRICE_LIST_ID);
    }

    /**
     * Set price_list_id
     * @param string $priceListId
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setPriceListId($priceListId)
    {
        return $this->setData(self::PRICE_LIST_ID, $priceListId);
    }

    /**
     * Get all_groups
     * @return string|null
     */
    public function getAllGroups()
    {
        return $this->getData(self::ALL_GROUPS);
    }

    /**
     * Set all_groups
     * @param string $allGroups
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setAllGroups($allGroups)
    {
        return $this->setData(self::ALL_GROUPS, $allGroups);
    }

    /**
     * Get customer_group_id
     * @return string
     */
    public function getCustomerGroupId()
    {
        return $this->getData(self::CUSTOMER_GROUP_ID);
    }

    /**
     * Set customer_group_id
     * @param string $customerGroupId
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setCustomerGroupId($customerGroupId)
    {
        return $this->setData(self::CUSTOMER_GROUP_ID, $customerGroupId);
    }

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getWebsiteId()
    {
        return $this->getData(self::WEBSITE_ID);
    }

    /**
     * Set website_id
     * @param string $websiteId
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setWebsiteId($websiteId)
    {
        return $this->setData(self::WEBSITE_ID, $websiteId);
    }
}
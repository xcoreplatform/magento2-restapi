<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListCustomerGroupWebsiteInterface
{
    const ID                = 'id';
    const PRICE_LIST_ID     = 'price_list_id';
    const ALL_GROUPS        = 'all_groups';
    const CUSTOMER_GROUP_ID = 'customer_group_id';
    const WEBSITE_ID        = 'website_id';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setId($id);

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getPriceListId();

    /**
     * Set price_list_id
     * @param string $priceListId
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setPriceListId($priceListId);

    /**
     * Get all_groups
     * @return string|null
     */
    public function getAllGroups();

    /**
     * Set all_groups
     * @param string $all_groups
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setAllGroups($all_groups);

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getCustomerGroupId();

    /**
     * Set customer_group_id
     * @param string $customerGroupId
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setCustomerGroupId($customerGroupId);

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getWebsiteId();

    /**
     * Set website_id
     * @param string $websiteId
     * @return PriceListCustomerGroupWebsiteInterface
     */
    public function setWebsiteId($websiteId);
}
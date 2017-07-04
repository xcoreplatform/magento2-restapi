<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListCustomerGroupInterface
{
    const ID                = 'id';
    const CUSTOMER_GROUP_ID = 'customer_group_id';
    const PRICE_LIST_ID     = 'price_list_id';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return PriceListCustomerGroupInterface
     */
    public function setId($id);

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getCustomerGroupId();

    /**
     * Set customer_group_id
     * @param string $customerGroupId
     * @return PriceListCustomerGroupInterface
     */
    public function setCustomerGroupId($customerGroupId);

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getPriceListId();

    /**
     * Set price_list_id
     * @param string $priceListId
     * @return PriceListCustomerGroupInterface
     */
    public function setPriceListId($priceListId);
}
<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListCustomerGroupInterface
{
    const ID                = 'id';
    const PRICE_LIST_ID     = 'price_list_id';
    const CUSTOMER_GROUP_ID = 'customer_group_id';

    /**
     * Get id
     *
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     *
     * @param string $id
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface
     */
    public function setId($id);

    /**
     * Get guid
     *
     * @return int
     */
    public function getPriceListId();

    /**
     * Set guid
     *
     * @param int $priceListId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface
     */
    public function setPriceListId($priceListId);

    /**
     * Get code
     *
     * @return int
     */
    public function getCustomerGroupId();

    /**
     * Set code
     *
     * @param int $customerGroupId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface
     */
    public function setCustomerGroupId($customerGroupId);
}

<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListInterface
{
    const ID              = 'id';
    const GUID            = 'guid';
    const CODE            = 'code';
    const ITEMS           = 'items';
    const ITEM_GROUPS     = 'item_groups';
    const CUSTOMER_GROUPS = 'customer_group_ids';

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
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setId($id);

    /**
     * Get guid
     *
     * @return string|null
     */
    public function getGuid();

    /**
     * Set guid
     *
     * @param string $guid
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setGuid($guid);

    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setCode($code);

    /**
     * Get customer groups
     *
     * @return mixed
     */
    public function getCustomerGroupIds();

    /**
     * Set Customer Groups
     *
     * @param $customer_group_ids
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setCustomerGroupIds($customer_group_ids);

    /**
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[]
     */
    public function getItems();

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[] $items
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setItems($items);

    /**
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[]
     */
    public function getItemGroups();

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[] $item_groups
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setItemGroups($item_groups);
}

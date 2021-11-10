<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListInterface
{
    const ID             = 'id';
    const GUID           = 'guid';
    const CODE           = 'code';
    const ITEMS          = 'items';
    const CUSTOMER_GROUP = 'customer_group';

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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setCode($code);

    /**
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[]
     */
    public function getItems();

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[] $items
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setItems($items);

    /**
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface[]
     */
    public function getCustomerGroup();

    /**
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface[] $items
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function setCustomerGroup($customerGroup);
}

<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListItemGroupInterface
{
    const ID            = 'id';
    const PRICE_LIST_ID = 'price_list_id';
    const ITEM_GROUP    = 'item_group';
    const QTY           = 'qty';
    const DISCOUNT      = 'discount';
    const START_DATE    = 'start_date';
    const END_DATE      = 'end_date';
    const PROCESSED     = 'processed';
    const CREATED_AT    = 'created_at';
    const UPDATED_AT    = 'updated_at';
    const ERROR_COUNT   = 'error_count';

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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setId($id);

    /**
     * Get price_list_id
     *
     * @return string|null
     */
    public function getPriceListId();

    /**
     * Set price_list_id
     *
     * @param string $price_list_id
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setPriceListId($price_list_id);

    /**
     * Get item_group
     *
     * @return string|null
     */
    public function getItemGroup();

    /**
     * Set item_group
     *
     * @param string $item_group
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setItemGroup($item_group);

    /**
     * Get qty
     *
     * @return string|null
     */
    public function getQty();

    /**
     * Set qty
     *
     * @param string $qty
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setQty($qty);

    /**
     * Get discount
     *
     * @return string|null
     */
    public function getDiscount();

    /**
     * Set price
     *
     * @param string $price
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setDiscount($discount);

    /**
     * Get start_date
     *
     * @return string|null
     */
    public function getStartDate();

    /**
     * Set start_date
     *
     * @param string $start_date
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setStartDate($start_date);

    /**
     * Get end_date
     *
     * @return string|null
     */
    public function getEndDate();

    /**
     * Set end_date
     *
     * @param string $end_date
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setEndDate($end_date);

    /**
     * Get processed
     *
     * @return string
     */
    public function getProcessed();

    /**
     * Set processed
     *
     * @param string $int
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setProcessed($int);

    /**
     * Get error_count
     *
     * @return string
     */
    public function getErrorCount();

    /**
     * Get error_count
     *
     * @param string $int
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setErrorCount($error_count);

    /**
     * Get updated_at
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     *
     * @param string $updated_at
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setUpdatedAt($updated_at);

    /**
     * Get created_at
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $created_at
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     */
    public function setCreatedAt($created_at);
}

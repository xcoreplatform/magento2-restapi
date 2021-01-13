<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListItemInterface
{
    const ID            = 'id';
    const PRICE_LIST_ID = 'price_list_id';
    const PRODUCT_SKU   = 'product_sku';
    const QTY           = 'qty';
    const PRICE         = 'price';
    const START_DATE    = 'start_date';
    const END_DATE      = 'end_date';
    const PROCESSED     = 'processed';
    const ERROR_COUNT   = 'error_count';
    const UPDATED_AT    = 'updated_at';
    const CREATED_AT    = 'created_at';

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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     */
    public function setPriceListId($price_list_id);

    /**
     * Get product_sku
     *
     * @return string|null
     */
    public function getProductSku();

    /**
     * Set product_sku
     *
     * @param string $product_sku
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     */
    public function setProductSku($product_sku);

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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     */
    public function setQty($qty);

    /**
     * Get price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     *
     * @param string $price
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     */
    public function setPrice($price);

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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     */
    public function setCreatedAt($created_at);
}

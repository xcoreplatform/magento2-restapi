<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListInterface
{
    const ID          = 'id';
    const LIST_ID     = 'list_id';
    const CUSTOMER_ID = 'customer_id';
    const PRODUCT_ID  = 'product_id';
    const QTY         = 'qty';
    const PRICE       = 'price';
    const FROM_DATE   = 'from_date';
    const TO_DATE     = 'to_date';

    /**
     * Get id
     * @return string|null
     */

    public function getId();

    /**
     * Set id
     * @param string $id
     * @return PriceListInterface
     */

    public function setId($id);

    /**
     * Get list_id
     * @return string|null
     */

    public function getListId();

    /**
     * Set list_id
     * @param string $list_id
     * @return PriceListInterface
     */

    public function setListId($list_id);

    /**
     * Get customer_id
     * @return string|null
     */

    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customer_id
     * @return PriceListInterface
     */

    public function setCustomerId($customer_id);

    /**
     * Get product_id
     * @return string|null
     */

    public function getProductId();

    /**
     * Set product_id
     * @param string $product_id
     * @return PriceListInterface
     */

    public function setProductId($product_id);

    /**
     * Get qty
     * @return string|null
     */

    public function getQty();

    /**
     * Set qty
     * @param string $qty
     * @return PriceListInterface
     */

    public function setQty($qty);

    /**
     * Get price
     * @return string|null
     */

    public function getPrice();

    /**
     * Set price
     * @param string $price
     * @return PriceListInterface
     */

    public function setPrice($price);

    /**
     * Get from_date
     * @return string|null
     */

    public function getFromDate();

    /**
     * Set from_date
     * @param string $from_date
     * @return PriceListInterface
     */

    public function setFromDate($from_date);

    /**
     * Get to_date
     * @return string|null
     */

    public function getToDate();

    /**
     * Set to_date
     * @param string $to_date
     * @return PriceListInterface
     */

    public function setToDate($to_date);
}
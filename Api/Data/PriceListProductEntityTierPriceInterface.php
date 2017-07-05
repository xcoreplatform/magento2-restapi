<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListProductEntityTierPriceInterface
{
    const ID            = 'id';
    const PRICE_LIST_ID = 'price_list_id';
    const PRODUCT_ID    = 'product_id';
    const QTY           = 'qty';
    const VALUE         = 'value';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return PriceListProductEntityTierPriceInterface
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
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setPriceListId($priceListId);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $product_id
     * @return PriceListProductEntityTierPriceInterface
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
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setQty($qty);

    /**
     * Get value
     * @return string|null
     */
    public function getValue();

    /**
     * Set value
     * @param string $value
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setValue($value);
}
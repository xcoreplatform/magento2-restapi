<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListInterface;
use Magento\Framework\Model\AbstractModel;

class PriceList extends AbstractModel implements PriceListInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dealer4dealer\Xcore\Model\ResourceModel\PriceList');
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
     * @return PriceListInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get list_id
     * @return string
     */
    public function getListId()
    {
        return $this->getData(self::LIST_ID);
    }

    /**
     * Set list_id
     * @param string $list_id
     * @return PriceListInterface
     */
    public function setListId($list_id)
    {
        return $this->setData(self::LIST_ID, $list_id);
    }

    /**
     * Get customer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customer_id
     * @return PriceListInterface
     */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    /**
     * Get product_id
     * @return string
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $product_id
     * @return PriceListInterface
     */
    public function setProductId($product_id)
    {
        return $this->setData(self::PRODUCT_ID, $product_id);
    }

    /**
     * Get qty
     * @return string
     */
    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    /**
     * Set qty
     * @param string $qty
     * @return PriceListInterface
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * Get price
     * @return string
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * Set price
     * @param string $price
     * @return PriceListInterface
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * Get from_date
     * @return string
     */
    public function getFromDate()
    {
        return $this->getData(self::FROM_DATE);
    }

    /**
     * Set from_date
     * @param string $from_date
     * @return PriceListInterface
     */
    public function setFromDate($from_date)
    {
        return $this->setData(self::FROM_DATE, $from_date);
    }

    /**
     * Get to_date
     * @return string
     */
    public function getToDate()
    {
        return $this->getData(self::TO_DATE);
    }

    /**
     * Set to_date
     * @param string $to_date
     * @return PriceListInterface
     */
    public function setToDate($to_date)
    {
        return $this->setData(self::TO_DATE, $to_date);
    }
}
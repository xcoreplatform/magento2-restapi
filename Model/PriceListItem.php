<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListItem extends \Magento\Framework\Model\AbstractModel implements
    \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getPriceListId()
    {
        return $this->getData(self::PRICE_LIST_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setPriceListId($price_list_id)
    {
        return $this->setData(self::PRICE_LIST_ID, $price_list_id);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductSku()
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductSku($product_sku)
    {
        return $this->setData(self::PRODUCT_SKU, $product_sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    /**
     * {@inheritdoc}
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * {@inheritdoc}
     */
    public function getStartDate()
    {
        return $this->getData(self::START_DATE);
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate($start_date)
    {
        return $this->setData(self::START_DATE, $start_date);
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate()
    {
        return $this->getData(self::END_DATE);
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate($end_date)
    {
        return $this->setData(self::END_DATE, $end_date);
    }

    /**
     * {@inheritdoc}
     */
    public function getProcessed()
    {
        return $this->getData(self::PROCESSED);
    }

    /**
     * {@inheritdoc}
     */
    public function setProcessed($int)
    {
        return $this->setData(self::PROCESSED, $int);
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorCount()
    {
        return $this->getData(self::ERROR_COUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setErrorCount($error_count)
    {
        return $this->setData(self::ERROR_COUNT, $error_count);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }
}

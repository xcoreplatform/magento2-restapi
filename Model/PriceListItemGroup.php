<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListItemGroup extends \Magento\Framework\Model\AbstractModel implements
    \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Dealer4dealer\Xcore\Model\ResourceModel\PriceListItemGroup::class);
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
    public function getItemGroup()
    {
        return $this->getData(self::ITEM_GROUP);
    }

    /**
     * {@inheritdoc}
     */
    public function setItemGroup($item_group)
    {
        return $this->setData(self::ITEM_GROUP, $item_group);
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
    public function getDiscount()
    {
        return $this->getData(self::DISCOUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setDiscount($discount)
    {
        return $this->setData(self::DISCOUNT, $discount);
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

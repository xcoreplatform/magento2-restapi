<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListCustomerGroup extends \Magento\Framework\Model\AbstractModel implements
    \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface
{
    /** @var \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[] */
    protected $items;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroup::class);
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
    public function setPriceListId($priceListId)
    {
        return $this->setData(self::PRICE_LIST_ID, $priceListId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerGroupId()
    {
        return $this->getData(self::CUSTOMER_GROUP_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomerGroupId($customerGroupId)
    {
        return $this->setData(self::CUSTOMER_GROUP_ID, $customerGroupId);
    }
}

<?php

namespace Dealer4dealer\Xcore\Model;

class PriceList extends \Magento\Framework\Model\AbstractModel implements \Dealer4dealer\Xcore\Api\Data\PriceListInterface
{
    /** @var \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[] */
    protected $items;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Dealer4dealer\Xcore\Model\ResourceModel\PriceList::class);
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
    public function getGuid()
    {
        return $this->getData(self::GUID);
    }

    /**
     * {@inheritdoc}
     */
    public function setGuid($guid)
    {
        return $this->setData(self::GUID, $guid);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->getData(self::ITEMS);
    }

    /**
     * {@inheritdoc}
     */
    public function setItems($items)
    {
        return $this->setData(self::ITEMS, $items);
    }

    public function getCustomerGroup()
    {
        return $this->getData(self::CUSTOMER_GROUP);

    }

    public function setCustomerGroup($customerGroup)
    {
        return $this->setData(self::CUSTOMER_GROUP, $customerGroup);

    }
}

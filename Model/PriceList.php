<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListItemInterface;
use Magento\Framework\Model\AbstractModel;

class PriceList extends AbstractModel implements PriceListInterface
{
    /** @var PriceListItemInterface[] */
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
}

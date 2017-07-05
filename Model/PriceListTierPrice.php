<?php

namespace Dealer4dealer\Xcore\Model;

class PriceListTierPrice
{
    public $entityId;
    public $qty;
    public $value;

    /**
     * @return integer
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @return float
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param integer $entityId
     * @return PriceListTierPrice
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
        return $this;
    }

    /**
     * @param float $qty
     * @return PriceListTierPrice
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
        return $this;
    }

    /**
     * @param float $value
     * @return PriceListTierPrice
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
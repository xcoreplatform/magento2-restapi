<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PaymentCostInterface;
use Magento\Framework\DataObject;

class PaymentCost extends DataObject implements PaymentCostInterface
{
    protected $title;
    protected $baseAmount;
    protected $amount;
    protected $taxPercent;

    protected $extensionAttributes;

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseAmount()
    {
        return $this->getData(self::BASE_AMOUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseAmount($baseAmount)
    {
        return $this->setData(self::BASE_AMOUNT, $baseAmount);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxPercent()
    {
        return $this->getData(self::TAX_PERCENT);
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxPercent($taxPercent)
    {
        return $this->setData(self::TAX_PERCENT, $taxPercent);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensionAttributes()
    {
        return $this->getData(self::EXTENSION_ATTRIBUTES_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function setExtensionAttributes(\Dealer4dealer\Xcore\Api\Data\PaymentCostInterface $extensionAttributes)
    {
        return $this->setData(self::EXTENSION_ATTRIBUTES_KEY, $extensionAttributes);
    }
}
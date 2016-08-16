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
     * Get the title of the payment cost.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set the title of the payment cost.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get the base amount of the payment cost.
     *
     * @return float|null
     */
    public function getBaseAmount()
    {
        return $this->getData(self::BASE_AMOUNT);
    }

    /**
     * Set the base amount of the payment cost.
     *
     * @param float $baseAmount
     * @return $this
     */
    public function setBaseAmount($baseAmount)
    {
        return $this->setData(self::BASE_AMOUNT, $baseAmount);
    }

    /**
     * Get the amount of the payment cost.
     * @return float|null
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * Set the amount of the payment cost.
     *
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * Get the tax rate of the payment cost.
     *
     * @return float|null
     */
    public function getTaxPercent()
    {
        return $this->getData(self::TAX_PERCENT);
    }

    /**
     * Set the tax rate of the payment cost.
     *
     * @param $taxPercent
     * @return mixed
     */
    public function setTaxPercent($taxPercent)
    {
        return $this->setData(self::TAX_PERCENT, $taxPercent);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PaymentCostExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->getData(self::EXTENSION_ATTRIBUTES_KEY);
    }

    /**
     * Set an extension attributes object.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PaymentCostExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Dealer4dealer\Xcore\Api\Data\PaymentCostExtensionInterface $extensionAttributes
    )
    {
        return $this->setData(self::EXTENSION_ATTRIBUTES_KEY, $extensionAttributes);
    }
}
<?php
namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PaymentCostInterface extends ExtensibleDataInterface
{
    const TITLE         = 'title';
    const BASE_AMOUNT   = 'base_amount';
    const AMOUNT        = 'amount';
    const TAX_PERCENT   = 'tax_percent';

    /**
     * Get the title of the payment cost.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the title of the payment cost.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Get the base amount of the payment cost.
     *
     * @return float|null
     */
    public function getBaseAmount();

    /**
     * Set the base amount of the payment cost.
     *
     * @param float $baseAmount
     * @return $this
     */
    public function setBaseAmount($baseAmount);

    /**
     * Get the amount of the payment cost.
     * @return float|null
     */
    public function getAmount();

    /**
     * Set the amount of the payment cost.
     *
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount);

    /**
     * Get the tax rate of the payment cost.
     *
     * @return float|null
     */
    public function getTaxPercent();

    /**
     * Set the tax rate of the payment cost.
     *
     * @param $taxPercent
     * @return mixed
     */
    public function setTaxPercent($taxPercent);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PaymentCostExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PaymentCostExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Dealer4dealer\Xcore\Api\Data\PaymentCostExtensionInterface $extensionAttributes
    );
}
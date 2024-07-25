<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\TierPriceInterface;

interface TierPriceStorageInterface
{
    /**
     * Add or update product prices.
     * "Override" from \Magento\Catalog\Api\TierPriceStorageInterface::update
     *
     * @param TierPriceInterface[] $prices
     *
     * @return \Magento\Catalog\Api\Data\PriceUpdateResultInterface[]
     */
    public function update(array $prices);

    /**
     * Remove existing tier prices and replace them with the new ones.
     * "Override" from \Magento\Catalog\Api\TierPriceStorageInterface::replace
     *
     * @param TierPriceInterface[] $prices
     *
     * @return \Magento\Catalog\Api\Data\PriceUpdateResultInterface[]
     */
    public function replace(array $prices);

    /**
     * Delete product tier prices.
     * "Override" from \Magento\Catalog\Api\TierPriceStorageInterface::delete
     *
     * @param TierPriceInterface[] $prices
     *
     * @return \Magento\Catalog\Api\Data\PriceUpdateResultInterface[]
     */
    public function delete(array $prices);
}

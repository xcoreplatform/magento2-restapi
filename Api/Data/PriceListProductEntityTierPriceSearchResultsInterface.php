<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListProductEntityTierPriceSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get PriceListProductEntityTierPrice list.
     * @return PriceListProductEntityTierPriceInterface[]
     */
    public function getItems();

    /**
     * Set PriceListProductEntityTierPrice list.
     * @param PriceListProductEntityTierPriceInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
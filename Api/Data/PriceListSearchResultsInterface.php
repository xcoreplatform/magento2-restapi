<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get price_list list.
     *
     * @return PriceListInterface[]
     */
    public function getItems();

    /**
     * Set price_list list.
     *
     * @param PriceListInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

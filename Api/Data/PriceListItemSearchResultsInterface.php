<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListItemSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get price_list_item list.
     *
     * @return PriceListItemInterface[]
     */
    public function getItems();

    /**
     * Set price_list_item list.
     *
     * @param PriceListItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

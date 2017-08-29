<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListItemSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get price_list_item list.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[]
     */
    public function getItems();

    /**
     * Set price_list_item list.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

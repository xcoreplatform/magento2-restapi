<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListItemSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
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
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterface
     */
    public function setItems(array $items);
}

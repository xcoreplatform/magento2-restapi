<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListItemGroupSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get price_list_item_group list.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[]
     */
    public function getItems();

    /**
     * Set price_list_item_group list.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[] $items
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupSearchResultsInterface
     */
    public function setItems(array $items);
}

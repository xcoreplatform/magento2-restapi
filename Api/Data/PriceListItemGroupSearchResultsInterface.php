<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListItemGroupSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get price_list_item_group list.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[]
     */
    public function getItemGroups();

    /**
     * Set price_list_item_group list.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface[] $itemGroups
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupSearchResultsInterface
     */
    public function setItemGroups(array $itemGroups);
}

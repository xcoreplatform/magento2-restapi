<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get price_list list.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface[]
     */
    public function getItems();

    /**
     * Set price_list list.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface[] $items
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListSearchResultsInterface
     */
    public function setItems(array $items);
}

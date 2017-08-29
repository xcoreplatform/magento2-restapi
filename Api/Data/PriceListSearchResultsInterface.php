<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListSearchResultsInterface extends SearchResultsInterface
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
     * @return $this
     */
    public function setItems(array $items);
}

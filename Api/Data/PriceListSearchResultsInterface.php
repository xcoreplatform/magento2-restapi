<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get PriceList list.
     * @return PriceListInterface[]
     */

    public function getItems();

    /**
     * Set id list.
     * @param PriceListInterface[] $items
     * @return $this
     */

    public function setItems(array $items);
}
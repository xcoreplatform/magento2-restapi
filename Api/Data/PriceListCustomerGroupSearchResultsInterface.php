<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListCustomerGroupSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get PriceListCustomerGroup list.
     * @return PriceListCustomerGroupInterface[]
     */
    public function getItems();

    /**
     * Set PriceListCustomerGroup list.
     * @param PriceListCustomerGroupInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
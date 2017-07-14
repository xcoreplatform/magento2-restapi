<?php

namespace Dealer4dealer\Xcore\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceListCustomerGroupWebsiteSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get PriceListCustomerGroupWebsite list.
     * @return PriceListCustomerGroupWebsiteInterface[]
     */
    public function getItems();

    /**
     * Set PriceListCustomerGroupWebsite list.
     * @param PriceListCustomerGroupWebsiteInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
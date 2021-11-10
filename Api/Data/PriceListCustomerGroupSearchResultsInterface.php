<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListCustomerGroupSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get price_list_customer_group list.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface[]
     */
    public function getItems();

    /**
     * Set price_list_customer_group list.
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface[] $items
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupSearchResultsInterface
     */
    public function setItems(array $items);
}

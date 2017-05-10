<?php


namespace Dealer4dealer\Xcore\Api\Data;

interface CustomAttributeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get CustomAttribute list.
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface[]
     */

    public function getItems();

    /**
     * Set from list.
     * @param \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface[] $items
     * @return $this
     */

    public function setItems(array $items);
}

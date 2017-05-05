<?php


namespace Dealer4dealer\Xcore\Api\Data;

interface CustomExampleAttributeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get CustomExampleAttribute list.
     * @return \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface[]
     */
    
    public function getItems();

    /**
     * Set from list.
     * @param \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}

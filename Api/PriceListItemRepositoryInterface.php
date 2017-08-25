<?php

namespace Dealer4dealer\Xcore\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListItemRepositoryInterface
{
    /**
     * Save price_list_item
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     * @throws LocalizedException
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem);

    /**
     * Retrieve price_list_item
     * @param string $priceListItemId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     * @throws LocalizedException
     */
    public function getById($priceListItemId);

    /**
     * Retrieve price_list_item matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list_item
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem);

    /**
     * Delete price_list_item by ID
     * @param string $priceListItemId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($priceListItemId);
}

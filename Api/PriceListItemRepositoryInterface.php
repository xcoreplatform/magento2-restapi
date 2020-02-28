<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\PriceListItemInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListItemRepositoryInterface
{
    /**
     * Save price_list_item
     *
     * @param PriceListItemInterface $priceListItem
     * @return PriceListItemInterface
     * @throws LocalizedException
     */
    public function save(PriceListItemInterface $priceListItem);

    /**
     * Retrieve price_list_item
     *
     * @param string $priceListItemId
     * @return PriceListItemInterface
     * @throws LocalizedException
     */
    public function getById($priceListItemId);

    /**
     * Retrieve price_list_item matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceListItemSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list_item
     *
     * @param PriceListItemInterface $priceListItem
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PriceListItemInterface $priceListItem);

    /**
     * Delete price_list_item by ID
     *
     * @param string $priceListItemId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($priceListItemId);
}

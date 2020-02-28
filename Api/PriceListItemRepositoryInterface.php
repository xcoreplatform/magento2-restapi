<?php

namespace Dealer4dealer\Xcore\Api;

interface PriceListItemRepositoryInterface
{
    /**
     * Save price_list_item
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem);

    /**
     * Retrieve price_list_item
     *
     * @param string $priceListItemId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($priceListItemId);

    /**
     * Retrieve price_list_item matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list_item
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListItemInterface $priceListItem);

    /**
     * Delete price_list_item by ID
     *
     * @param string $priceListItemId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($priceListItemId);
}

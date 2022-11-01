<?php

namespace Dealer4dealer\Xcore\Api;

interface PriceListItemGroupRepositoryInterface
{
    /**
     * Save price_list_item_group
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface $priceListItemGroup
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface $priceListItemGroup);

    /**
     * Retrieve price_list_item_group
     *
     * @param string $priceListItemGroupId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($priceListItemGroupId);

    /**
     * Retrieve price_list_item_group matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list_item_group
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface $priceListItemGroup
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListItemGroupInterface $priceListItemGroup);

    /**
     * Delete price_list_item by ID
     *
     * @param string $priceListItemGroupId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($priceListItemGroupId);
}

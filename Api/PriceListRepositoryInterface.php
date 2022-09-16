<?php

namespace Dealer4dealer\Xcore\Api;

interface PriceListRepositoryInterface
{
    /**
     * Save price_list
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList);

    /**
     * Retrieve price_list by id
     *
     * @param string $priceListId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($priceListId);

    /**
     * Retrieve price_list matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList);

    /**
     * Delete price_list by ID
     *
     * @param string $priceListId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($priceListId);

    /**
     * Get a JSON result with all price lists.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface[]
     */
    public function getJsonList();

    /**
     * Get a JSON result of a specific price list
     *
     * @param string $id
     * @param bool   $withItems
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function getJsonById($id, $withItems);

    /**
     * Get a JSON result of a specific price list
     *
     * @param string $guid
     * @param bool   $withItems
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function getJsonByGuid($guid, $withItems);

    /**
     * Save a JSON price list
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $price_list
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function saveJson(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $price_list);
}

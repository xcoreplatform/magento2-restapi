<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\PriceListInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListRepositoryInterface
{
    /**
     * Save price_list
     *
     * @param PriceListInterface $priceList
     * @return PriceListInterface
     * @throws LocalizedException
     */
    public function save(PriceListInterface $priceList);

    /**
     * Retrieve price_list by id
     *
     * @param string $priceListId
     * @return PriceListInterface
     * @throws LocalizedException
     */
    public function getById($priceListId);

    /**
     * Retrieve price_list matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceListSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list
     *
     * @param PriceListInterface $priceList
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PriceListInterface $priceList);

    /**
     * Delete price_list by ID
     *
     * @param string $priceListId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($priceListId);

    /**
     * Get a JSON result with all price lists.
     *
     * @return PriceListInterface[]
     */
    public function getJsonList();

    /**
     * Get a JSON result of a specific price list
     *
     * @param string $id
     * @param bool   $withItems
     * @return PriceListInterface
     */
    public function getJsonById($id, $withItems);

    /**
     * Get a JSON result of a specific price list
     *
     * @param string $guid
     * @param bool   $withItems
     * @return PriceListInterface
     */
    public function getJsonByGuid($guid, $withItems);

    /**
     * Save a JSON price list
     *
     * @param PriceListInterface $price_list
     * @return PriceListInterface
     */
    public function saveJson(PriceListInterface $price_list);
}

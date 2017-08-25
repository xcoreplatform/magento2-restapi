<?php

namespace Dealer4dealer\Xcore\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListRepositoryInterface
{
    /**
     * Save price_list
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     * @throws LocalizedException
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList);

    /**
     * Retrieve price_list by id
     * @param string $priceListId
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     * @throws LocalizedException
     */
    public function getById($priceListId);

    /**
     * Retrieve price_list matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $priceList);

    /**
     * Delete price_list by ID
     * @param string $priceListId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
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
     * @param bool $withItems
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function getJsonById(string $id, bool $withItems);

    /**
     * Get a JSON result of a specific price list
     *
     * @param string $guid
     * @param bool $withItems
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function getJsonByGuid(string $guid, bool $withItems);

    /**
     * Save a JSON price list
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListInterface $price_list
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListInterface
     */
    public function saveJson(\Dealer4dealer\Xcore\Api\Data\PriceListInterface $price_list);
}

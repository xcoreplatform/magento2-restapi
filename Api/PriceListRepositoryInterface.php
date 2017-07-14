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
     * Save PriceList
     * @param PriceListInterface $priceList
     * @return PriceListInterface
     * @throws LocalizedException
     */
    public function save(
        PriceListInterface $priceList
    );

    /**
     * Retrieve PriceList
     * @param string $id
     * @return PriceListInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve PriceList matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceListSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PriceList
     * @param PriceListInterface $priceList
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        PriceListInterface $priceList
    );

    /**
     * Delete PriceList by ID
     * @param string $id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);

    /**
     * Delete PriceList by PriceListId
     * @param string $priceListId
     * @return PriceListInterface
     * @throws LocalizedException
     */
    public function deleteByPriceListId($priceListId);
}
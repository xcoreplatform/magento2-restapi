<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListCustomerGroupRepositoryInterface
{
    /**
     * Save PriceListCustomerGroup
     * @param PriceListCustomerGroupInterface $priceListCustomerGroup
     * @return PriceListCustomerGroupInterface
     * @throws LocalizedException
     */
    public function save(
        PriceListCustomerGroupInterface $priceListCustomerGroup
    );

    /**
     * Retrieve PriceListCustomerGroup
     * @param string $id
     * @return PriceListCustomerGroupInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve PriceListCustomerGroup matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceListCustomerGroupSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PriceListCustomerGroup
     * @param PriceListCustomerGroupInterface $priceListCustomerGroup
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        PriceListCustomerGroupInterface $priceListCustomerGroup
    );

    /**
     * Delete PriceListCustomerGroup by ID
     * @param string $id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);

    /**
     * Delete PriceListCustomerGroup by CustomerGroupId
     * @param string $customerGroupId
     * @return PriceListCustomerGroupInterface
     * @throws LocalizedException
     */
    public function deleteByCustomerGroupId($customerGroupId);

    /**
     * Delete PriceListCustomerGroup by PriceListId
     * @param string $priceListId
     * @return PriceListCustomerGroupInterface
     * @throws LocalizedException
     */
    public function deleteByPriceListId($priceListId);
}
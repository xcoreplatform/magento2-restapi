<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupWebsiteSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListCustomerGroupWebsiteRepositoryInterface
{
    /**
     * Save PriceListCustomerGroupWebsite
     * @param PriceListCustomerGroupWebsiteInterface $priceListCustomerGroupWebsite
     * @return PriceListCustomerGroupWebsiteInterface
     * @throws LocalizedException
     */
    public function save(
        PriceListCustomerGroupWebsiteInterface $priceListCustomerGroupWebsite
    );

    /**
     * Retrieve PriceListCustomerGroupWebsite
     * @param string $id
     * @return PriceListCustomerGroupWebsiteInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve PriceListCustomerGroupWebsite matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceListCustomerGroupWebsiteSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PriceListCustomerGroupWebsite
     * @param PriceListCustomerGroupWebsiteInterface $priceListCustomerGroupWebsite
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        PriceListCustomerGroupWebsiteInterface $priceListCustomerGroupWebsite
    );

    /**
     * Delete PriceListCustomerGroupWebsite by ID
     * @param string $id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);
}
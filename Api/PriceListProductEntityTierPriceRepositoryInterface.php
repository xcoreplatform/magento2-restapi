<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\PriceListProductEntityTierPriceInterface;
use Dealer4dealer\Xcore\Api\Data\PriceListProductEntityTierPriceSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PriceListProductEntityTierPriceRepositoryInterface
{
    /**
     * Save PriceListProductEntityTierPrice
     * @param PriceListProductEntityTierPriceInterface $priceListProductEntityTierPrice
     * @return PriceListProductEntityTierPriceInterface
     * @throws LocalizedException
     */
    public function save(
        PriceListProductEntityTierPriceInterface $priceListProductEntityTierPrice
    );

    /**
     * Retrieve PriceListProductEntityTierPrice
     * @param string $id
     * @return PriceListProductEntityTierPriceInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve PriceListProductEntityTierPrice matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceListProductEntityTierPriceSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PriceListProductEntityTierPrice
     * @param PriceListProductEntityTierPriceInterface $priceListProductEntityTierPrice
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        PriceListProductEntityTierPriceInterface $priceListProductEntityTierPrice
    );

    /**
     * Delete PriceListProductEntityTierPrice by ID
     * @param string $id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);
}
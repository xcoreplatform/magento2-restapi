<?php

namespace Dealer4dealer\Xcore\Api;

interface PriceListCustomerGroupRepositoryInterface
{
    /**
     * Save price_list
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface $priceList
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface $priceList);

    /**
     * Retrieve price_list_customer_group by id
     *
     * @param int $price_list_customer_group_id
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($price_list_customer_group_id);

    /**
     * Retrieve price_list_customer_group matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete price_list_customer_group
     *
     * @param \Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface $priceList
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Dealer4dealer\Xcore\Api\Data\PriceListCustomerGroupInterface $priceList);

    /**
     * Delete price_list_customer_group by ID
     *
     * @param string $priceListCustomerGroupId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($priceListCustomerGroupId);
}

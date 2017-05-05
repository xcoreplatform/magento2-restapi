<?php


namespace Dealer4dealer\Xcore\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomExampleAttributeRepositoryInterface
{


    /**
     * Save CustomExampleAttribute
     * @param \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface $customExampleAttribute
     * @return \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface $customExampleAttribute
    );

    /**
     * Retrieve CustomExampleAttribute
     * @param string $customexampleattributeId
     * @return \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($customexampleattributeId);

    /**
     * Retrieve CustomExampleAttribute matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CustomExampleAttribute
     * @param \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface $customExampleAttribute
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface $customExampleAttribute
    );

    /**
     * Delete CustomExampleAttribute by ID
     * @param string $customexampleattributeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($customexampleattributeId);
}

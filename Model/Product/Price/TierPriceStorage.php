<?php

namespace Dealer4dealer\Xcore\Model\Product\Price;

use Dealer4dealer\Xcore\Api\TierPriceStorageInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class TierPriceStorage implements TierPriceStorageInterface
{
    private $tierPriceStorage;
    private $customerGroupRepository;
    private $searchCriteriaBuilder;

    public function __construct(
        \Magento\Catalog\Api\TierPriceStorageInterface $tierPriceStorage,
        GroupRepositoryInterface                       $customerGroupRepository,
        SearchCriteriaBuilder                          $searchCriteriaBuilder,

    ) {
        $this->tierPriceStorage        = $tierPriceStorage;
        $this->customerGroupRepository = $customerGroupRepository;
        $this->searchCriteriaBuilder   = $searchCriteriaBuilder;
    }

    public function update(array $prices)
    {
        $prices = $this->resolveCustomerGroup($prices);
        return $this->tierPriceStorage->update($prices);
    }

    public function replace(array $prices)
    {
        $prices = $this->resolveCustomerGroup($prices);
        return$this->tierPriceStorage->replace($prices);
    }

    public function delete(array $prices)
    {
        $prices = $this->resolveCustomerGroup($prices);
        return$this->tierPriceStorage->delete($prices);
    }

    private function resolveCustomerGroup(array $prices):array
    {
        $customerGroups = $this->getCustomerGroups();
        foreach ($prices as $price) {
            $customerGroupId = $price['customer_group_id'] ?? null;
            if (!$customerGroupId) {
                continue;
            }
            unset($price['customer_group_id']);
            $price['customer_group'] = $customerGroups[$customerGroupId] ?? null;
        }
        return $prices;
    }

    private function getCustomerGroups():array
    {
        $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups([])
                                                      ->create();
        $customerGroups = $this->customerGroupRepository->getList($searchCriteria)->getItems();

        $list = [];
        foreach($customerGroups as $customerGroup) {
            $list[$customerGroup->getId()] = $customerGroup->getCode();
        }

        return $list;
    }
}
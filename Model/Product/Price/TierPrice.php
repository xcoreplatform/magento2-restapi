<?php

namespace Dealer4dealer\Xcore\Model\Product\Price;

use Dealer4dealer\Xcore\Api\Data\TierPriceInterface;
use Dealer4dealer\Xcore\Api\TierPriceStorageInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class TierPrice extends \Magento\Catalog\Model\Product\Price\TierPrice implements TierPriceInterface
{
    /**
     * {@inheritdoc}
     */
    public function setCustomerGroupId($customerGroupId)
    {
        return $this->setData(self::CUSTOMER_GROUP_ID, $customerGroupId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerGroupId()
    {
        return $this->getData(self::CUSTOMER_GROUP_ID);
    }
}

<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface TierPriceInterface extends \Magento\Catalog\Api\Data\TierPriceInterface
{
    const CUSTOMER_GROUP_ID = 'customer_group_id';

    /**
     * Set customer group id.
     *
     * @param int $customerGroupId
     *
     * @return $this
     * @since 102.0.0
     */
    public function setCustomerGroupId($customGroupId);

    /**
     * Get customer group id.
     *
     * @return int
     */
    public function getCustomerGroupId();
}

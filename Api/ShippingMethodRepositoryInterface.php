<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\ShippingMethodInterface;

interface ShippingMethodRepositoryInterface
{
    /**
     * Get a list of all shipping methods.
     *
     * @return ShippingMethodInterface[]
     */
    public function getList();
}
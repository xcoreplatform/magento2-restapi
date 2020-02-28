<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\MethodInterface;

interface ShippingMethodRepositoryInterface
{
    /**
     * Get a list of all shipping methods.
     *
     * @return MethodInterface[]
     */
    public function getList();
}
<?php

namespace Dealer4dealer\Xcore\Api;

interface ShippingMethodRepositoryInterface
{
    /**
     * Get a list of all shipping methods.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\ShippingMethodInterface[]
     */
    public function getList();
}
<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\OrderStateInterface;

interface OrderStateRepositoryInterface
{
    /**
     * Get a list of all order states.
     *
     * @return OrderStateInterface[]
     */
    public function getList();
}
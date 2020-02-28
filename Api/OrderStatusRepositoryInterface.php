<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\OrderStatusInterface;

interface OrderStatusRepositoryInterface
{
    /**
     * Get a list of all order states.
     *
     * @return OrderStatusInterface[]
     */
    public function getList();
}
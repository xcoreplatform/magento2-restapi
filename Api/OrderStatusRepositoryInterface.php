<?php

namespace Dealer4dealer\Xcore\Api;

interface OrderStatusRepositoryInterface
{
    /**
     * Get a list of all order states.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\OrderStatusInterface[]
     */
    public function getList();
}
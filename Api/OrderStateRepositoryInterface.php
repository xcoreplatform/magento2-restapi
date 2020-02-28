<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\StateInterface;

interface OrderStateRepositoryInterface
{
    /**
     * Get a list of all order states.
     *
     * @return StateInterface[]
     */
    public function getList();
}
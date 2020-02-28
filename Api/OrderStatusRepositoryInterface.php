<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\StatusInterface;

interface OrderStatusRepositoryInterface
{
    /**
     * Get a list of all order states.
     *
     * @return StatusInterface[]
     */
    public function getList();
}
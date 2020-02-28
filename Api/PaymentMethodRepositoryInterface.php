<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\MethodInterface;

interface PaymentMethodRepositoryInterface
{
    /**
     * Get a list of all payment methods.
     *
     * @return MethodInterface[]
     */
    public function getList();
}
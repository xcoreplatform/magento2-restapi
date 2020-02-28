<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\PaymentMethodInterface;

interface PaymentMethodRepositoryInterface
{
    /**
     * Get a list of all payment methods.
     *
     * @return PaymentMethodInterface[]
     */
    public function getList();
}
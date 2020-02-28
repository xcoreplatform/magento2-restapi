<?php

namespace Dealer4dealer\Xcore\Api;

interface PaymentMethodRepositoryInterface
{
    /**
     * Get a list of all payment methods.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\PaymentMethodInterface[]
     */
    public function getList();
}
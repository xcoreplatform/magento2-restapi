<?php
namespace Dealer4dealer\Xcore\Api;

interface PaymentMethodRepositoryInterface
{
    /**
     * Get a list of all payment methods.

     * @return array
     */
    public function getList();
}
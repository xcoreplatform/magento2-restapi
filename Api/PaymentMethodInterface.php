<?php
namespace Dealer4dealer\Xcore\Api;

interface PaymentMethodInterface
{
    /**
     * @return array
     */
    public function getList();
}
<?php
namespace Dealer4dealer\Xcore\Api;

interface ShippingMethodInterface
{
    /**
     * @return array
     */
    public function getList();
}
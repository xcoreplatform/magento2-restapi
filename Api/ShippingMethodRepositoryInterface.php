<?php
namespace Dealer4dealer\Xcore\Api;

interface ShippingMethodRepositoryInterface
{
    /**
     * Get a list of all shipping methods.

     * @return array
     */
    public function getList();
}
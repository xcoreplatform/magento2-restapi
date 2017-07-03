<?php

namespace Dealer4dealer\Xcore\Api;

interface PricelistManagementInterface
{
    /**
     * GET for pricelist api
     *
     * @return string
     */
    public function getPricelist();

    /**
     * POST for pricelist api
     *
     * @return string
     */
    public function postPricelist();
}
<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface ShippingMethodInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return ShippingMethodInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return ShippingMethodInterface
     */
    public function setName($name);
}

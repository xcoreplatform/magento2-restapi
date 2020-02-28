<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface OrderStatusInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return OrderStatusInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return OrderStatusInterface
     */
    public function setName($name);
}

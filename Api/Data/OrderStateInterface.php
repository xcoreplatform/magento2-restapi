<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface OrderStateInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return OrderStateInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return OrderStateInterface
     */
    public function setName($name);
}

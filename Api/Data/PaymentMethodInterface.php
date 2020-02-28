<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PaymentMethodInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return \Dealer4dealer\Xcore\Api\Data\PaymentMethodInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return \Dealer4dealer\Xcore\Api\Data\PaymentMethodInterface
     */
    public function setName($name);
}

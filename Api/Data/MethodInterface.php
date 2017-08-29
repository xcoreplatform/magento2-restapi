<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface MethodInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return \Dealer4dealer\Xcore\Api\Data\MethodInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return \Dealer4dealer\Xcore\Api\Data\MethodInterface
     */
    public function setName($name);
}

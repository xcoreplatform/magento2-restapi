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
     * @return MethodInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return MethodInterface
     */
    public function setName($name);
}

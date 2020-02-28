<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface StateInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return StateInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return StateInterface
     */
    public function setName($name);
}

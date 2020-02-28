<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface StatusInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return StatusInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return StatusInterface
     */
    public function setName($name);
}

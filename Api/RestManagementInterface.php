<?php

namespace Dealer4dealer\Xcore\Api;

interface RestManagementInterface
{
    /**
     * Returns the version of the xCore Rest API.
     *
     * @return string
     */
    public function getVersion();
}
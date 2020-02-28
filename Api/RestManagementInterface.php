<?php

namespace Dealer4dealer\Xcore\Api;

interface RestManagementInterface
{
    /**
     * Returns the version of the xCore Rest API.
     *
     * @return \Dealer4dealer\Xcore\Api\Data\VersionInterface
     */
    public function getVersion();
}
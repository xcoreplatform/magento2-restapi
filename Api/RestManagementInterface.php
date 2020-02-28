<?php

namespace Dealer4dealer\Xcore\Api;

use Dealer4dealer\Xcore\Api\Data\VersionInterface;

interface RestManagementInterface
{
    /**
     * Returns the version of the xCore Rest API.
     *
     * @return VersionInterface
     */
    public function getVersion();
}
<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface VersionInterface
{
    /**
     * @return string
     */
    public function getMagentoVersion();

    /**
     * @param string $version
     * @return \Dealer4dealer\Xcore\Api\Data\VersionInterface
     */
    public function setMagentoVersion($version);

    /**
     * @return string
     */
    public function getMagentoEdition();

    /**
     * @param string $edition
     * @return \Dealer4dealer\Xcore\Api\Data\VersionInterface
     */
    public function setMagentoEdition($edition);

    /**
     * @return string
     */
    public function getRestVersion();

    /**
     * @param string $version
     * @return \Dealer4dealer\Xcore\Api\Data\VersionInterface
     */
    public function setRestVersion($version);
}

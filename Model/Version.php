<?php

namespace Dealer4dealer\Xcore\Model;

class Version implements \Dealer4dealer\Xcore\Api\Data\VersionInterface
{
    protected $magentoVersion;
    protected $magentoEdition;
    protected $restVersion;

    /**
     * {@inheritdoc}
     */
    public function getMagentoVersion()
    {
        return $this->magentoVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setMagentoVersion($version)
    {
        $this->magentoVersion = $version;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMagentoEdition()
    {
        return $this->magentoEdition;
    }

    /**
     * {@inheritdoc}
     */
    public function setMagentoEdition($edition)
    {
        $this->magentoEdition = $edition;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRestVersion()
    {
        return $this->restVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setRestVersion($version)
    {
        $this->restVersion = $version;

        return $this;
    }
}

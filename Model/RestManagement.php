<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\RestManagementInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Module\ModuleListInterface;

class RestManagement implements RestManagementInterface
{
    const MODULE_NAME = 'Dealer4dealer_Xcore';

    protected $productMetadata;
    protected $moduleList;

    public function __construct(ProductMetadataInterface $productMetadata,
                                ModuleListInterface $moduleList)
    {
        $this->productMetadata = $productMetadata;
        $this->moduleList      = $moduleList;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        $magentoVersion = $this->productMetadata->getVersion();
        $magentoEdition = $this->productMetadata->getEdition();
        $restVersion    = $this->moduleList->getOne(self::MODULE_NAME)['setup_version'];

        $result = new Version;
        $result->setMagentoVersion($magentoVersion);
        $result->setMagentoEdition($magentoEdition);
        $result->setRestVersion($restVersion);

        return $result;
    }
}

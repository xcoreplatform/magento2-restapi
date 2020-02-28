<?php

namespace Dealer4dealer\Xcore\Model;

class RestManagement implements \Dealer4dealer\Xcore\Api\RestManagementInterface
{
    const MODULE_NAME = 'Dealer4dealer_Xcore';
    protected $productMetadata;
    protected $moduleList;

    public function __construct(\Magento\Framework\App\ProductMetadataInterface $productMetadata,
                                \Magento\Framework\Module\ModuleListInterface $moduleList)
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

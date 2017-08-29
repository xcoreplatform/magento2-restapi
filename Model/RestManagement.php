<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\RestManagementInterface;
use Magento\Framework\Module\ModuleListInterface;

class RestManagement implements RestManagementInterface
{
    const MODULE_NAME = 'Dealer4dealer_Xcore';

    protected $moduleList;

    public function __construct(ModuleListInterface $moduleList)
    {
        $this->moduleList = $moduleList;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return $this->moduleList->getOne(self::MODULE_NAME)['setup_version'];
    }
}

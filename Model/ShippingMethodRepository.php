<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\ShippingMethodRepositoryInterface;
use Magento\Shipping\Model\Config;

class ShippingMethodRepository implements ShippingMethodRepositoryInterface
{
    /**@var Config */
    private $shippingConfig;

    /**
     * ShippingMethodRepository constructor.
     *
     * @param Config $shippingConfig
     */
    public function __construct(Config $shippingConfig)
    {
        $this->shippingConfig = $shippingConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getList()
    {
        $response = [];

        foreach ($this->shippingConfig->getActiveCarriers() as $code => $carrier) {

            $title = $carrier->getConfigData('title');

            foreach($carrier->getAllowedMethods() as $methodCode => $method) {
                $model = new Method;
                $model->setCode($code."_".$methodCode);
                $model->setName($title. " - ".$method);

                $response[] = $model;
            }
        }

        return $response;
    }
}
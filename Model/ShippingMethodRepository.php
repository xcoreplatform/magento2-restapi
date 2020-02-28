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

        if (!$this->shippingConfig->getActiveCarriers()) {
            return $response;
        }

        foreach ($this->shippingConfig->getActiveCarriers() as $code => $carrier) {
            $title = $carrier->getConfigData('title');

            if (!$carrier->getAllowedMethods()) {
                continue;
            }

            foreach ($carrier->getAllowedMethods() as $methodCode => $method) {
                $model = new ShippingMethod;
                $model->setCode($code . "_" . $methodCode);
                $model->setName($title . " - " . $method);

                $response[] = $model;
            }
        }

        return $response;
    }
}
<?php

namespace Dealer4dealer\Xcore\Model;

class ShippingMethodRepository implements \Dealer4dealer\Xcore\Api\ShippingMethodRepositoryInterface
{
    /**@var \Magento\Shipping\Model\Config */
    private $shippingConfig;

    /**
     * ShippingMethodRepository constructor.
     *
     * @param \Magento\Shipping\Model\Config $shippingConfig
     */
    public function __construct(\Magento\Shipping\Model\Config $shippingConfig)
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
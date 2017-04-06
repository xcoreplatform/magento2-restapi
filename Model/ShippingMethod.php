<?php
namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\ShippingMethodInterface;
use Magento\Shipping\Model\Config;

class ShippingMethod implements ShippingMethodInterface
{
    /**
     * @var Config
     */
    private $shippingConfig;

    /**
     * ShippingMethod constructor.
     * @param Config $shippingConfig
     */
    public function __construct(Config $shippingConfig)
    {
        $this->shippingConfig = $shippingConfig;
    }

    /**
     * Get a list of all shipping methods
     * @return array
     */
    public function getList()
    {
        $response = [];

        foreach ($this->shippingConfig->getActiveCarriers() as $code => $carrier) {

            $title = $carrier->getConfigData('title');

            foreach($carrier->getActiveMethods() as $activeMethod) {
                $response[] = [
                    'code'  => $code."_".$activeMethod->getCode(),
                    'name'  => $title. " - ".$activeMethod->getTitle(),
                ];
            }
        }

        return $response;
    }
}
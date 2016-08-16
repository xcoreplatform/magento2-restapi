<?php
namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\PaymentMethodInterface;

class PaymentMethod implements PaymentMethodInterface
{
    /**
     * @var \Magento\Payment\Helper\Data
     */
    private $paymentHelper;

    public function __construct(
        \Magento\Payment\Helper\Data $paymentHelper
    )
    {
        $this->paymentHelper = $paymentHelper;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $response = [];

        foreach ($this->paymentHelper->getPaymentMethodList() as $code => $name) {
            $response[] = [
                'code'  => $code,
                'name'  => $name,
            ];
        }

        return $response;
    }
}
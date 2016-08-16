<?php
namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\PaymentMethodRepositoryInterface;
use Magento\Payment\Helper\Data;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    /**
     * @var Data
     */
    private $paymentHelper;

    /**
     * PaymentMethodRepository constructor.
     * @param Data $paymentHelper
     */
    public function __construct(Data $paymentHelper)
    {
        $this->paymentHelper = $paymentHelper;
    }

    /**
     * Get a list of all payment methods.

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
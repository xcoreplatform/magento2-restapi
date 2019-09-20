<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\PaymentMethodRepositoryInterface;
use Magento\Payment\Helper\Data;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    /** @var Data */
    private $paymentHelper;

    /**
     * PaymentMethodRepository constructor.
     *
     * @param Data $paymentHelper
     */
    public function __construct(Data $paymentHelper)
    {
        $this->paymentHelper = $paymentHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getList()
    {
        $response = [];

        if (!$this->paymentHelper->getPaymentMethodList()) {
            return $response;
        }

        foreach ($this->paymentHelper->getPaymentMethodList() as $code => $name) {
            $model = new Method;
            $model->setCode($code);
            $model->setName($name);

            $response[] = $model;
        }

        return $response;
    }
}
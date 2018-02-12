<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\OrderStateRepositoryInterface;

class OrderStateRepository implements OrderStateRepositoryInterface
{

    private $statusCollection;

    public function __construct(
        Magento\Sales\Model\ResourceModel\Order\Status\Collection $statusCollection
    )
    {
        $this->statusCollection = $statusCollection;
    }


    public function getList()
    {
        $response = [];

        $orderStates = $this->statusCollection->toOptionArray();

        foreach ($orderStates as $code => $name) {
            $model = new OrderState();
            $model->setCode($code);
            $model->setName($name);

            $response[] = $model;
        }

        return $response;
    }
}
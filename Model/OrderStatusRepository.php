<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\OrderStatusRepositoryInterface;

class OrderStatusRepository implements OrderStatusRepositoryInterface
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

        $orderStatuses = $this->statusCollection->toOptionArray();

        foreach ($orderStatuses as $code => $name) {
            $model = new OrderStatus();
            $model->setCode($code);
            $model->setName($name);

            $response[] = $model;
        }

        return $orderStatuses;
    }
}
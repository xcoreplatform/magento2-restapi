<?php

namespace Dealer4dealer\Xcore\Model;

class OrderStatusRepository implements \Dealer4dealer\Xcore\Api\OrderStatusRepositoryInterface
{
    private $statusCollection;

    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\Status\Collection $statusCollection
    )
    {
        $this->statusCollection = $statusCollection;
    }

    public function getList()
    {
        $response = [];

        $orderStatuses = $this->statusCollection->toOptionArray();

        foreach ($orderStatuses as $status) {
            $model = new OrderStatus();
            $model->setCode($status['value']);
            $model->setName($status['label']);

            $response[] = $model;
        }

        return $response;
    }
}
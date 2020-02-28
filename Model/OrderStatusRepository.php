<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\OrderStatusRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Order\Status\Collection;

class OrderStatusRepository implements OrderStatusRepositoryInterface
{
    private $statusCollection;

    public function __construct(
        Collection $statusCollection
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
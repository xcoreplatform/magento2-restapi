<?php

namespace Dealer4dealer\Xcore\Model;

class OrderStateRepository implements \Dealer4dealer\Xcore\Api\OrderStateRepositoryInterface
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
        $states = $this->statusCollection->joinStates()->toArray()['items'];

        $response = [];
        foreach ($states as $state) {
            $model = new OrderState();
            $model->setCode($state['state']);
            $model->setName($state['state']);

            $response[] = $model;
        }
        return $response;
    }
}
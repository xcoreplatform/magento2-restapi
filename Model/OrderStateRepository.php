<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\OrderStateRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Order\Status\Collection;

class OrderStateRepository implements OrderStateRepositoryInterface
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
        $states = $this->statusCollection->joinStates()->toArray()['items'];

        $response = [];
        foreach ($states as $state) {
            if (!is_null($state['state'])) {
                $response[$state['state']] = [
                    'code' => $state['state'],
                    'name' => $state['state']
                ];
            }
        }
        return array_values($response);
    }
}
<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\AlterShipmentInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Sales\Api\ShipmentRepositoryInterface;

class AlterShipment extends AbstractModel implements AlterShipmentInterface
{
    /** @var ShipmentRepositoryInterface */
    private $shipmentRepository;

    /**
     * @param ShipmentRepositoryInterface $shipmentRepository
     */
    public function __construct(ShipmentRepositoryInterface $shipmentRepository)
    {
        $this->shipmentRepository = $shipmentRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($shipmentId,
                            $xcoreYourRef)
    {
        $result = null;

        try {
            $shipment = $this->shipmentRepository->get($shipmentId);
            $shipment->setXcoreYourRef($xcoreYourRef);
            $shipment->save();

            $result = 'success';
        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }
}

<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\AlterShipmentInterface;
use Magento\Sales\Api\ShipmentRepositoryInterface;

class AlterShipment extends \Magento\Framework\Model\AbstractModel implements AlterShipmentInterface
{
    /**
     * @var ShipmentRepositoryInterface
     */
    private $shipmentRepository;

    /**
     * @param ShipmentRepositoryInterface $shipmentRepository
     */
    public function __construct(
        ShipmentRepositoryInterface $shipmentRepository
    ) {
        $this->shipmentRepository = $shipmentRepository;
    }

    /**
     * Alters a given Shipment, currently only by adding a reference.
     *
     * @param int $shipmentId
     * @param string $xcoreYourRef
     * @return string Either 'success' or the exception message.
     */
    public function execute(
        $shipmentId,
        $xcoreYourRef
    ) {
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

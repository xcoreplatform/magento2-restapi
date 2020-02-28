<?php

namespace Dealer4dealer\Xcore\Model;

class AlterShipment extends \Magento\Framework\Model\AbstractModel implements \Dealer4dealer\Xcore\Api\AlterShipmentInterface
{
    /** @var \Magento\Sales\Api\ShipmentRepositoryInterface */
    private $shipmentRepository;

    /**
     * @param \Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository
     */
    public function __construct(\Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository)
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

<?php

namespace Dealer4dealer\Xcore\Api;

interface AlterShipmentInterface
{
    /**
     * Alters a given Shipment, currently only by adding a reference.
     *
     * @param int    $shipmentId
     * @param string $xcoreYourRef
     * @return string Either 'success' or the exception message.
     */
    public function execute(
        $shipmentId,
        $xcoreYourRef
    );
}
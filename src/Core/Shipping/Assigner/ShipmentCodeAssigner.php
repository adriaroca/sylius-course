<?php

namespace App\Core\Shipping\Assigner;

use App\Provider\ShipmentRandomCodeProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Core\Model\ShipmentInterface;

class ShipmentCodeAssigner implements ShipmentCodeAssignerInterface
{
    private ShipmentRandomCodeProviderInterface $shipmentRandomCodeProvider;
    private EntityManagerInterface $shipmentManager;

    /**
     * @param ShipmentRandomCodeProviderInterface $shipmentRandomCodeProvider
     * @param EntityManagerInterface $shipmentManager
     */
    public function __construct(ShipmentRandomCodeProviderInterface $shipmentRandomCodeProvider, EntityManagerInterface $shipmentManager)
    {
        $this->shipmentRandomCodeProvider = $shipmentRandomCodeProvider;
        $this->shipmentManager = $shipmentManager;
    }

    public function assign(ShipmentInterface $shipment): void
    {
        if($shipment->getState() !== ShipmentInterface::STATE_SHIPPED) {
            return;
        }

        $randomTrackingNumber = $this->shipmentRandomCodeProvider->provide();
        $shipment->setTracking($randomTrackingNumber);

        $this->shipmentManager->flush();
    }
}

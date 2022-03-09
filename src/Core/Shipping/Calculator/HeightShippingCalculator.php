<?php

namespace App\Core\Shipping\Calculator;

use App\Service\OrderService;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;

class HeightShippingCalculator implements \Sylius\Component\Shipping\Calculator\CalculatorInterface
{
    private OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param ShipmentInterface $subject
     * @param array $configuration<int max_height, float above_or_equal, float below>
     * @return int
     */
    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        /** @var OrderInterface|null $order */
        $order = $subject->getOrder();

        if(null === $order) {
            return $configuration['below'];
        }

        $isHigherThan = $this->orderService->checkIfHeightIsHigherThan($order, $configuration['max_height']);

        if($isHigherThan) {
            return $configuration['above_or_equal'];
        }

        return $configuration['below'];
    }

    public function getType(): string
    {
        return 'height_based';
    }
}

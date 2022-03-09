<?php

namespace App\Service;

use Sylius\Component\Core\Model\OrderInterface;

class OrderService
{
    public function checkIfHeightIsHigherThan(OrderInterface $order, int $maxHeight): bool
    {
        $items = $order->getItems();
        $totalHeight = 0.0;

        foreach ($items as $item) {
            $totalHeight += $item->getVariant()->getHeight();
        }

        return $totalHeight >= $maxHeight;
    }
}

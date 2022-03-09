<?php

namespace App\Tests\Unit\Service\OrderService;

use App\Service\OrderService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;

class CheckIfHeightIsHigherThanOrderServiceTest extends TestCase
{
    private OrderService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new OrderService();
    }

    public function test_is_higher_than()
    {
        $order = $this->createMock(OrderInterface::class);
        $orderItem = $this->createMock(OrderItemInterface::class);
        $variant = $this->createMock(ProductVariantInterface::class);
        $orderItems = new ArrayCollection([$orderItem]);

        $order->expects(self::once())
            ->method('getItems')
            ->willReturn($orderItems);

        $orderItem->expects(self::once())
            ->method('getVariant')
            ->willReturn($variant);

        $variant->expects(self::once())
            ->method('getHeight')
            ->willReturn(6.1);

        $isHigherThan = $this->service->checkIfHeightIsHigherThan($order, 5);

        self::assertTrue($isHigherThan);
    }

    public function test_is_shorter_than()
    {
        $order = $this->createMock(OrderInterface::class);
        $orderItem = $this->createMock(OrderItemInterface::class);
        $variant = $this->createMock(ProductVariantInterface::class);
        $orderItems = new ArrayCollection([$orderItem]);

        $order->expects(self::once())
            ->method('getItems')
            ->willReturn($orderItems);

        $orderItem->expects(self::once())
            ->method('getVariant')
            ->willReturn($variant);

        $variant->expects(self::once())
            ->method('getHeight')
            ->willReturn(4.9);

        $isHigherThan = $this->service->checkIfHeightIsHigherThan($order, 5);

        self::assertFalse($isHigherThan);
    }
}

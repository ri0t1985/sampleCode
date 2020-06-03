<?php

namespace Erik\Sample\Supplier;

use Erik\Sample\Supplier\Service\BarOrderService;
use Erik\Sample\Supplier\Service\FooOrderService;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;

class SupplierFactoryTest extends TestCase
{
    /** @var SupplierFactory */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();
        $this->subject = new SupplierFactory();
    }

    /**
     * @dataProvider orderServiceSuccessProvider
     *
     * @param string $brandName
     * @param string $expectedOrderService
     */
    public function testGetOrderServiceSuccess(string $brandName, string $expectedOrderService)
    {
        $response = $this->subject->getOrderServiceByBrandName($brandName);
        $this->assertInstanceOf($expectedOrderService, $response);
    }

    public static function orderServiceSuccessProvider(): array
    {
        return [
            ['foo', FooOrderService::class],
            ['bar', BarOrderService::class],
        ];
    }

    public function testGetOrderServiceNotFound(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid brand provided: something invalid');
        $this->subject->getOrderServiceByBrandName('something invalid');
    }
}

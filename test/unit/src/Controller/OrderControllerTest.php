<?php

namespace Erik\Sample\Controller;

use Erik\Sample\Supplier\Service\FooOrderService;
use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Erik\Sample\Supplier\Service\ValueObjects\OrderResult;
use Erik\Sample\Supplier\SupplierFactory;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderControllerTest extends TestCase
{
    /** @var OrderController */
    private $subject;

    /** @var SupplierFactory|MockInterface */
    private $supplierFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->supplierFactory = \Mockery::mock(SupplierFactory::class);
        $this->subject = new OrderController($this->supplierFactory);
    }

    public function testPlaceOrderSuccess(): void
    {
        $orderService = \Mockery::mock(FooOrderService::class);
        $this->supplierFactory
            ->shouldReceive('getOrderServiceByBrandName')
            ->once()
            ->with('some brand')
            ->andReturn($orderService);

        $orderRequest = new OrderRequest();
        $orderRequest
            ->setProductNumber('P1231231')
            ->setCustomerNumber('C12314511')
            ->setQuantity(12);

        $orderResult = new OrderResult();
        $orderResult->setOrderNr(4321);
        $orderResult->setMetaData(['some data']);

        $orderService->shouldReceive('placeOrder')
            ->once()
            ->with(\Mockery::mustBe($orderRequest))
            ->andReturn($orderResult);

        $response = $this->subject->placeOrder('some brand');
        $this->assertEquals(JsonResponse::HTTP_ACCEPTED, $response->getStatusCode());
        $response = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $expected = [
            'result' => true,
            'message' => 'Order successfully placed',
            'orderNr' => 4321,
        ];
        $this->assertEquals($expected, $response);
    }
}

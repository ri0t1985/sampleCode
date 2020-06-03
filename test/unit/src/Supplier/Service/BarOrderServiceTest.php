<?php

namespace Erik\Sample\Supplier\Service;

use Erik\Sample\Supplier\Client\BarRestClient;
use Erik\Sample\Supplier\Service\Exception\OrderFailedException;
use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use Mockery\MockInterface;

class BarOrderServiceTest extends TestCase
{
    /** @var BarOrderService */
    private $subject;

    /** @var BarRestClient|MockInterface */
    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = \Mockery::mock(BarRestClient::class);
        $this->subject = new BarOrderService($this->client);
    }

    public function testPlaceOrderSuccess(): void
    {
        $orderRequest = new OrderRequest();
        $orderRequest
            ->setQuantity(123)
            ->setProductNumber('TEST1234')
            ->setCustomerNumber('TESTCUSTOMER');

        $this->client->shouldReceive('call')
            ->once()
            ->with('orderMethod', $orderRequest->toArray())
            ->andReturn(10202020);

        $response = $this->subject->placeOrder($orderRequest);
        $this->assertEquals(10202020, $response->getOrderNr());
        $this->assertEquals([], $response->getMetaData());
    }

    public function testPlaceOrderFailureIsSuccessfullyCaught(): void
    {
        $orderRequest = new OrderRequest();
        $orderRequest
            ->setQuantity(123)
            ->setProductNumber('TEST1234')
            ->setCustomerNumber('TESTCUSTOMER');

        $this->client->shouldReceive('call')
            ->once()
            ->with('orderMethod', $orderRequest->toArray())
            ->andThrow(new \Exception('something went wrong'));

        $this->expectException(OrderFailedException::class);
        $this->expectExceptionMessage('something went wrong');

        $this->subject->placeOrder($orderRequest);
    }
}

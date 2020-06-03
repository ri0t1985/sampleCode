<?php

namespace Erik\Sample\Supplier\Service;

use Erik\Sample\Supplier\Client\FooSoapClient;
use Erik\Sample\Supplier\Service\Exception\OrderFailedException;
use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use Mockery\MockInterface;

class FooOrderServiceTest extends TestCase
{
    /** @var FooOrderService */
    private $subject;

    /** @var FooSoapClient|MockInterface */
    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = \Mockery::mock(FooSoapClient::class);
        $this->subject = new FooOrderService($this->client);
    }

    public function testPlaceOrderSuccess(): void
    {
        $orderRequest = new OrderRequest();
        $this->client->shouldReceive('call')
            ->once()
            ->with($orderRequest)
            ->andReturn(10202020);
        $this->client->shouldReceive('getOrderMetaData')
            ->once()
            ->withNoArgs()
            ->andReturn(['some data']);

        $response = $this->subject->placeOrder($orderRequest);
        $this->assertEquals(10202020, $response->getOrderNr());
        $this->assertEquals(['some data'], $response->getMetaData());
    }

    public function testPlaceOrderFailureIsSuccessfullyCaught(): void
    {
        $orderRequest = new OrderRequest();
        $this->client->shouldReceive('call')
            ->once()
            ->with($orderRequest)
            ->andThrow(new \Exception('something went wrong'));

        $this->expectException(OrderFailedException::class);
        $this->expectExceptionMessage('something went wrong');

        $this->subject->placeOrder($orderRequest);
    }
}

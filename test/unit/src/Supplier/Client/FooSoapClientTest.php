<?php

namespace Erik\Sample\Supplier\Client;

use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;

class FooSoapClientTest extends TestCase
{

    /** @var FooSoapClient */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();
        $this->subject = new FooSoapClient();
    }

    public function testCall(): void
    {
        $this->assertEmpty($this->subject->getOrderMetaData());
        $response = $this->subject->call(new OrderRequest());
        $orderMetaData = $this->subject->getOrderMetaData();
        $this->assertNotEmpty($orderMetaData);
        $this->assertEquals(55555, $response);
        // date time might flip a second, so a small delta is allowed
        $this->assertInstanceOf(\DateTime::class, $orderMetaData['orderDate']);
        $this->assertInstanceOf(\DateTime::class, $orderMetaData['expectedDeliveryDate']);
        $this->assertEquals(new \DateTime('01-02-2029'), $orderMetaData['expectedDeliveryDate']);
    }
}

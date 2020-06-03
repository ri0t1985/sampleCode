<?php

namespace Erik\Sample\Supplier\Service\ValueObjects;

use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;

class OrderRequestTest extends TestCase
{
    /** @var OrderRequest */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();
        $this->subject = new OrderRequest();
    }

    public function testSetProductNumber(): void
    {
        $this->subject->setProductNumber('T12312');
        $this->assertEquals('T12312', $this->subject->getProductNumber());
        $this->subject->setProductNumber('T322322');
        $this->assertEquals('T322322', $this->subject->getProductNumber());
    }

    public function testSetCustomerNumber(): void
    {
        $this->subject->setCustomerNumber('T12312');
        $this->assertEquals('T12312', $this->subject->getCustomerNumber());
        $this->subject->setCustomerNumber('T322322');
        $this->assertEquals('T322322', $this->subject->getCustomerNumber());
    }

    public function testSetQuantity(): void
    {
        $this->subject->setQuantity(123);
        $this->assertEquals(123, $this->subject->getQuantity());
        $this->subject->setQuantity(4323);
        $this->assertEquals(4323, $this->subject->getQuantity());
    }
}

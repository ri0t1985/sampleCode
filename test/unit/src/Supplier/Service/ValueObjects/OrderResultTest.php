<?php

namespace Erik\Sample\Supplier\Service\ValueObjects;

use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;

class OrderResultTest extends TestCase
{
    /** @var OrderResult */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();
        $this->subject = new OrderResult();
    }

    public function testSetOrderNr(): void
    {
        $this->subject->setOrderNr(123);
        $this->assertEquals(123, $this->subject->getOrderNr());
        $this->subject->setOrderNr(321);
        $this->assertEquals(321, $this->subject->getOrderNr());
    }

    public function testSetMetaData(): void
    {
        $this->assertEmpty($this->subject->getMetaData());
        $this->subject->setMetaData(['meta' => 'data']);
        $this->assertEquals(['meta' => 'data'], $this->subject->getMetaData());
    }
}

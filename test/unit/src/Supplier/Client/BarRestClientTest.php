<?php

namespace Erik\Sample\Supplier\Client;

use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;

class BarRestClientTest extends TestCase
{
    /** @var BarRestClient */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();
        $this->subject = new BarRestClient();
    }

    public function testCall(): void
    {
        $response = $this->subject->call('some method', []);
        $this->assertEquals(123, $response);
    }
}

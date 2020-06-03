<?php

namespace Erik\Sample\Supplier\Client;

use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;

class FooSoapClient
{
    /**
     * @var array
     */
    private $orderMetaData = [];

    public function call(OrderRequest $orderRequest): int
    {
        // build xml

        // send xml

        // parse response xml

        // set meta data
        $this->orderMetaData = [
            'orderDate' => new \DateTime('now'),
            'expectedDeliveryDate' => new \DateTime('01-02-2029'),
        ];

        // return order number
        return 55555;
    }

    /**
     * @return array
     */
    public function getOrderMetaData(): array
    {
        return $this->orderMetaData;
    }
}

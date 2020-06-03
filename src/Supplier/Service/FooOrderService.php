<?php

namespace Erik\Sample\Supplier\Service;

use Erik\Sample\Supplier\Client\FooSoapClient;
use Erik\Sample\Supplier\Service\Exception\OrderFailedException;
use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Erik\Sample\Supplier\Service\ValueObjects\OrderResult;

class FooOrderService implements OrderServiceInterface
{

    /** @var FooSoapClient */
    private $soapClient;

    public function __construct(FooSoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    public function placeOrder(OrderRequest $orderRequest): OrderResult
    {
        try {
            $orderNumber = $this->soapClient->call($orderRequest);
        } catch (\Exception $exception) {
            throw new OrderFailedException('Order interface returned error: ' . $exception->getMessage());
        }
        $orderResult = new OrderResult();
        $orderResult->setOrderNr($orderNumber);
        $orderResult->setMetaData($this->soapClient->getOrderMetaData());
        return $orderResult;
    }
}
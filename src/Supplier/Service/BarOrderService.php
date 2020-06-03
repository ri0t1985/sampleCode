<?php

namespace Erik\Sample\Supplier\Service;

use Erik\Sample\Supplier\Client\BarRestClient;
use Erik\Sample\Supplier\Service\Exception\OrderFailedException;
use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Erik\Sample\Supplier\Service\ValueObjects\OrderResult;

class BarOrderService implements OrderServiceInterface
{
    /** @var BarRestClient */
    private $barRestClient;

    /**
     * @param BarRestClient $barRestClient
     */
    public function __construct(BarRestClient $barRestClient)
    {
        $this->barRestClient = $barRestClient;
    }

    /**
     * @param OrderRequest $orderRequest
     * @return OrderResult
     */
    public function placeOrder(OrderRequest $orderRequest): OrderResult
    {
        try {
            $orderNumber = $this->barRestClient->call('orderMethod', $orderRequest->toArray());
            $orderResult = new OrderResult();
            $orderResult->setOrderNr($orderNumber);
            return $orderResult;
        } catch (\Throwable $e) {
            throw new OrderFailedException($e->getMessage());
        }
    }
}

<?php

namespace Erik\Sample\Supplier\Service;

use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Erik\Sample\Supplier\Service\ValueObjects\OrderResult;

interface OrderServiceInterface
{
    public function placeOrder(OrderRequest $orderRequest): OrderResult;
}

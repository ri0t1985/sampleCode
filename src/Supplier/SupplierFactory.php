<?php

namespace Erik\Sample\Supplier;

use Erik\Sample\Supplier\Client\BarRestClient;
use Erik\Sample\Supplier\Client\FooSoapClient;
use Erik\Sample\Supplier\Service\BarOrderService;
use Erik\Sample\Supplier\Service\FooOrderService;
use Erik\Sample\Supplier\Service\OrderServiceInterface;

class SupplierFactory
{
    /**
     * @param string $brandName
     * @return OrderServiceInterface
     * @throws \InvalidArgumentException
     */
    public function getOrderServiceByBrandName(?string $brandName): OrderServiceInterface
    {
        $brandName = strtolower($brandName);
        switch ($brandName) {
            case 'foo':
                return $this->getFooOrderService();
            case 'bar':
                return $this->getBarOrderService();
            default:
                throw new \InvalidArgumentException('Invalid brand provided: ' . $brandName);
        }
    }

    /**
     * @return FooOrderService
     */
    private function getFooOrderService(): FooOrderService
    {
        return new FooOrderService(
            new FooSoapClient()
        );
    }

    private function getBarOrderService(): BarOrderService
    {
        return new BarOrderService(
            new BarRestClient()
        );
    }
}

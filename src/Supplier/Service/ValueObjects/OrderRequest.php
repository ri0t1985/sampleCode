<?php

namespace Erik\Sample\Supplier\Service\ValueObjects;

class OrderRequest
{
    /** @var string */
    private $productNumber;

    /** @var int */
    private $quantity;

    /** @var string */
    private $customerNumber;

    /**
     * @return string
     */
    public function getProductNumber(): string
    {
        return $this->productNumber;
    }

    /**
     * @param string $productNumber
     * @return OrderRequest
     */
    public function setProductNumber(string $productNumber): OrderRequest
    {
        $this->productNumber = $productNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return OrderRequest
     */
    public function setQuantity($quantity): OrderRequest
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return $this->customerNumber;
    }

    /**
     * @param string $customerNumber
     * @return OrderRequest
     */
    public function setCustomerNumber(string $customerNumber): OrderRequest
    {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function toArray()
    {
        return [
          'productNumber' => $this->getProductNumber(),
          'customerNumber' => $this->getCustomerNumber(),
          'quantity' => $this->getQuantity(),
        ];
    }
}
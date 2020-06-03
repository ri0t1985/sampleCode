<?php

namespace Erik\Sample\Supplier\Service\ValueObjects;

class OrderResult
{
    /** @var string */
    private $orderNr;

    /** @var array */
    private $metaData = [];

    /**
     * @return string
     */
    public function getOrderNr(): ?string
    {
        return $this->orderNr;
    }

    /**
     * @param string $orderNr
     * @return OrderResult
     */
    public function setOrderNr(string $orderNr): OrderResult
    {
        $this->orderNr = $orderNr;
        return $this;
    }

    public function setMetaData(array $metaData): OrderResult
    {
        $this->metaData = $metaData;
        return $this;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }
}

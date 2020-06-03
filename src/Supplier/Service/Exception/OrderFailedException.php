<?php

namespace Erik\Sample\Supplier\Service\Exception;

class OrderFailedException extends \RuntimeException
{
    /**
     * @var mixed
     */
    private $response;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * @return $this
     */
    public function setResponse($response): self
    {
        $this->response = $response;
        return $this;
    }
}

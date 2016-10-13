<?php

namespace Skydrop\Order;

class OrderBuilder
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $pickup;
    private $delivery;
    private $service;
    private $package;

    public function __construct($pickup, $delivery, $service, $package)
    {
        $this->pickup   = $pickup;
        $this->delivery = $delivery;
        $this->service  = $service;
        $this->package  = $package;
    }

    public function toHash()
    {
        return array_merge(
            $this->pickup->toHash('pickup'),
            $this->delivery->toHash('delivery'),
            $this->service->toHash(),
            $this->package->toHash()
        );
    }
}

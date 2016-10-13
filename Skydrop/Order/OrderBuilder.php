<?php

namespace Skydrop\Order;

class OrderBuilder
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    protected $args;
    private   $pickup;
    private   $delivery;
    private   $service;
    private   $package;

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

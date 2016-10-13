<?php

namespace Skydrop\Order;

class OrderBuilder
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $pickup;
    private $delivery;
    private $service;
    private $package;

    public function __construct($args=[])
    {
        $this->pickup   = $args['pickup'];
        $this->delivery = $args['delivery'];
        $this->service  = $args['service'];
        $this->package  = $args['package'];
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

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
        $this->pickup   = $this->getFromArray('pickup', $args, '');
        $this->delivery = $this->getFromArray('delivery', $args, '');
        $this->service  = $this->getFromArray('service', $args, '');
        $this->package  = $this->getFromArray('package', $args, '');
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

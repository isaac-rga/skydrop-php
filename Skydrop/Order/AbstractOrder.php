<?php

namespace Skydrop\Order;

abstract class AbstractOrder
{
    protected $args;
    public $pickup;
    public $delivery;
    public $service;
    public $package;

    abstract protected function pickupClass();
    abstract protected function deliveryClass();
    abstract protected function serviceClass();
    abstract protected function packageClass();

    public function __construct($args)
    {
        $serviceClass = $this->serviceClass();
        $packageClass = $this->packageClass();
        $this->args =  $args;
        $this->origin = initAddress('pickup');
        $this->destination = initAddress('delivery');
        $this->service = new $serviceClass($args);
        $this->package = new $packageClass($args);
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

    private function initAddress($category)
    {
        $className = call_user_func(array($this, "{$category}Class"));
        return new $className($this->args);
    }
}

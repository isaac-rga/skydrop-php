<?php

namespace Skydrop\Order;

abstract class AbstractOrderAdapter
{
    protected $pickup;
    protected $delivery;
    protected $adaptedPickup;
    protected $adaptedDelivery;
    protected $args;

    abstract protected function initPickup();
    abstract protected function initDelivery();
    abstract protected function pickupClass();
    abstract protected function deliveryClass();
    abstract protected function hasCashOnDelivery();

    public function __construct($args)
    {
        $this->pickup = $this->initPickup($args);
        $this->delivery = $this->initDelivery($args);
    }

    public function toJson()
    {
        return array(
            'pickup' => adaptedAddress('pickup')->toJson(),
            'delivery' => adaptedAddress('delivery')->toJson(),
            'service' => adaptedService()->toJson()
        );
    }

    protected function adaptedAddress($category)
    {
        $adaptedVar = "adapted{ucfirst($category)}";
        if (isset($this->$adaptedVar)) {
            return $this->$adaptedVar;
        }

        return $this->$adaptedVar = address($category);
    }

    private function address($category)
    {
        $className = call_user_func(array($this, "{$category}Class"));
        return new $className($this->$category);
    }

}

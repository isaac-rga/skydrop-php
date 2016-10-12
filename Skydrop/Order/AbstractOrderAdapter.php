<?php

namespace Skydrop\Order;

abstract class AbstractOrderAdapter
{
    protected $args;
    public $origin;
    public $destination;
    public $service;
    public $package;

    abstract protected function originClass();
    abstract protected function destinationClass();
    abstract protected function serviceClass();
    abstract protected function packageClass();

    public function __construct($args)
    {
        $serviceClass = $this->serviceClass();
        $packageClass = $this->packageClass();
        $this->args =  $args;
        $this->origin = initAddress('origin');
        $this->destination = initAddress('destination');
        $this->service = new $serviceClass($args);
        $this->package = new $packageClass($args);
    }

    private function initAddress($category)
    {
        $className = call_user_func(array($this, "{$category}Class"));
        return new $className($this->args);
    }

    public function toJson()
    {
        return array(
            'pickup' => addressHash($origin),
            'delivery' => addressHash($destination),
            'service' => serviceHash(),
            'package' => packageHash(),
        );
    }

    protected function addressHash($address)
    {
        return array(
            'name' => $address->name(),
            'email' => $address->email(),
            'street_name_and_number' => $address->streetNameAndNumber(),
            'municipality' => $address->municipality(),
            'neighborhood' => $address->neighborhood(),
            'telephone' => $address->telephone(),
        );
    }

    protected function serviceHash()
    {
        return array(
            'service_code' => $service->serviceCode(),
            'vehicle_type' => $service->vehicleType(),
            'schedule_date' => $service->scheduleDate(),
            'starting_hour' => $service->startingHour(),
            'ending_hour' => $service->endingHour(),
        );
    }

    protected function packageHash()
    {
        return array(
            'cash_on_delivery' => $package->cashOnDelivery(),
            'cod_amount' => $package->codAmount(),
        );
    }
}

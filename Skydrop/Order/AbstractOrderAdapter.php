<?php

namespace Skydrop\Order;

abstract class AbstractOrderAdapter
{
    protected $args;
    public $origin;
    public $destination;
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

    public function toJson()
    {
        return array_merge(
            addressHash($origin, 'origin'),
            addressHash($destination, 'destination'),
            serviceHash(),
            packageHash()
        );
    }

    protected function needsCashOnDelivery()
    {
        return false;
    }

    private function initAddress($category)
    {
        $className = call_user_func(array($this, "{$category}Class"));
        return new $className($this->args);
    }


    private function addressHash($address, $category)
    {
        return array(
            "{$category}" => array(
                'name' => $address->name(),
                'email' => $address->email(),
                'street_name_and_number' => $address->streetNameAndNumber(),
                'municipality' => $address->municipality(),
                'neighborhood' => $address->neighborhood(),
                'telephone' => $address->telephone(),)
            );
    }

    private function serviceHash()
    {
        return array(
            'service' => array(
                'service_code' => $service->serviceCode(),
                'vehicle_type' => $service->vehicleType(),
                'schedule_date' => $service->scheduleDate(),
                'starting_hour' => $service->startingHour(),
                'ending_hour' => $service->endingHour(),
            )
        );
    }

    private function packageHash()
    {
        if (needsCashOnDelivery()) {
            return array(
                'package' => array(
                    'cash_on_delivery' => $package->cashOnDelivery(),
                    'cod_amount' => $package->codAmount(),
                )
            );
        }

        return array();
    }
}

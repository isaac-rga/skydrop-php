<?php

namespace Skydrop\ShippingRate\Filter;

class VehicleType
{
    public $rates;

    public $vehicleTypes;

    public function __construct($rates = [], $options = array())
    {
        $this->rates = $rates;
        $this->vehicleTypes = $options['vehicleTypes'];
    }

    public function call()
    {
        $filteredRates = [];
        foreach ($this->rates as $rate) {
            if (in_array($rate->vehicle_type, $this->vehicleTypes)) {
                $filteredRates[] = $rate;
            }
        }
        return $filteredRates;
    }
}

<?php

namespace Skydrop\ShippingRate\Filter;

class ServiceType
{
    public $rates;
    public $serviceTypes;

    public function __construct($rates = [], $options = array())
    {
        $this->rates = $rates;
        $this->serviceTypes = $options['serviceTypes'];
    }

    public function call()
    {
        $filteredRates = [];
        foreach ($this->rates as $rate) {
            if (in_array($rate->service_code, $this->service_types) {
                $filteredRates[] = $rate;
            }
        }
        return $filteredRates;
    }
}

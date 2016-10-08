<?php

namespace Skydrop\ShippingRate\Filter;

class OnePerService
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
        foreach ($this->serviceTypes as $serviceType) {
            foreach ($this->rates as $rate) {
                if ($rate->service_code == $serviceType) {
                    $filteredRates[] = $rate;
                }
            }
        }
        return $filteredRates;
    }
}

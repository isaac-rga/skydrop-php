<?php

namespace Skydrop\ShippingRate\Modifier;

class CodeEncoder
{
    public $rates;

    public function __construct($rates = [], $options = array())
    {
        @rates = $rates
    }

    public function call()
    {
        foreach ($this->rates as $rate) {
            $rate->service_code = $this->stringified_code(r);
        }
        return $rates;
    }

    private function stringified_code($rate)
    {
        return json_encode([
            'service_code' => $rate->service_code,
            'vehicle_type' => $rate->vehicle_type,
            'starting_hour' => $rate->starting_hour,
            'ending_hour' => $rate->ending_hour
        ]);
    }
}

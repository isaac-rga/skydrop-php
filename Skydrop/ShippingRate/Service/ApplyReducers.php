<?php

namespace Skydrop\ShippingRate\Service;

class ApplyReducers
{
    public $rates;
    public $rawRates;
    public $filters;
    public $shippingParams;

    public function __construct($rawRates = [], $filters = [], $shippingParams = array())
    {
        $this->rawRates = $rawRates;
        $this->filters = $filters;
        $this->shippingParams = $shippingParams;
    }

    public function call()
    {
        if ($this->rates == []) {
            return [];
        }
        if ($this->filters == []) {
            return $this->rawRates;
        }
        return $this->filteredRates()
    }

    private function filteredRates()
    {
        $filteredRates = $this->rawRates;

        foreach ($this->filters as $filter) {
            try {
                $klass = $filter->klass;
                if (!isset($filter->options)) {
                    $filter->options = {};
                }
                $options = [ 'shipping' => $this->shippingParams ];
                array_merge($options, $filter->options);
                $filteredRates = (new $klass($filteredRates, $options)).call;
            } catch (Exception => e) {
                var_dump($e);
            }
        }

        return $filteredRates;
    }
}

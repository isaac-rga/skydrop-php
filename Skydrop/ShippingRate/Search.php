<?php

namespace Skydrop\ShippingRate;

class Search
{
    public $itemsParams;

    public $shippingParams;

    public $filters;

    public $modifiers;

    public $rules;

    public function __construct($shippingRate)
    {
        $this->itemsParams    = $shippingRate->items;
        $this->shippingParams = $shippingRate;
        $this->filters        = \Skydrop\Configs::$filters;
        $this->modifiers      = \Skydrop\Configs::$modifiers;
        $this->rules          = \Skydrop\Configs::$rules;
    }

    public function call()
    {
        if (!$this->orderEligible()) { return []; }
        $foundRates = $this->getRawRates();
        if (empty($foundRates)) { return []; }

        return $this->applyModifiers($this->applyFilters($foundRates));
    }

    private function orderEligible()
    {
        if (empty($this->rules)) { return true; }

        $rules = array_map(
            function($rate) {
                try {
                    $klass = new $rate->klass($this->itemsParams, $rate->options);
                    return $klass->call();
                } catch (Exception $e) { return true; }
            },
            $this->rules
        );

        return count(array_unique($rules));
    }

    public function getRawRates()
    {
        try {
            $klass    = new \Skydrop\API\ShippingRate();
            $response = $klass->all($this->shippingParams);
            $rates    = $response->rates;
            if (empty($rates)) {
                return [];
            } else {
                return $rates;
            }
        } catch (Exception $e) { return []; }
    }

    private function applyModifiers($rates)
    {
        $reducer = new \Skydrop\ShippingRate\Service\ApplyReducers(
            $rates, $this->modifiers, $this->shippingParams
        );
        return $reducer->call();
    }

    private function applyFilters($rates)
    {
        $reducer = new \Skydrop\ShippingRate\Service\ApplyReducers(
            $rates, $this->filters, $this->shippingParams
        );
        return $reducer->call();
    }
}

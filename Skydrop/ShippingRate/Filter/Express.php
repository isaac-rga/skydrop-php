<?php

namespace Skydrop\ShippingRate\Filter;

class Express
{
    public $rates;
    public $shopServiceTime;

    public function __construct($rates = [], $options = [])
    {
        $this->rates = $rates;
        $this->shopServiceTime = \Skydrop\Configs::getShopServiceTime();
    }

    public function call()
    {
        if (!$this->shopServiceTime->availableFor('express')) {
            $this->removeExpressRates();
        }
        return $this->rates;
    }

    private function removeExpressRates()
    {
        $this->rates = array_filter(
            $this->rates,
            function($rate) {
                return $rate->service_code != 'express';
            }
        );
    }
}

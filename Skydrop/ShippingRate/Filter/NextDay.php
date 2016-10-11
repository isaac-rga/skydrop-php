<?php

namespace Skydrop\ShippingRate\Filter;

class NextDay
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
        if (!$this->shopServiceTime->availableFor('next_day')) {
            $this->removeNextDayRates();
        }
        return $this->rates;
    }

    private function removeNextDayRates()
    {
        $this->rates = array_filter(
            $this->rates,
            function($rate) {
                return $rate->service_code != 'next_day';
            }
        );
    }
}

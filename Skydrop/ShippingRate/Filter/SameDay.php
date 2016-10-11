<?php

namespace Skydrop\ShippingRate\Filter;

class SameDay
{
    public $rates;
    public $shopServiceTime;

    public function __construct($rates = [], $options = [])
    {
        $this->rates = $rates;
        if (!empty($options['shopServiceTime'])) {
            $this->shopServiceTime = $options['shopServiceTime'];
        }
    }

    public function call()
    {
        if (!$this->shopServiceTime->availableFor('same_day')) {
            $this->removeSameDayRates();
        }
        if ($this->beforeSkydropTime()) {
            $this->changeRatesEndingHour();
        }
        return $this->rates;
    }

    private function removeSameDayRates()
    {
        $this->rates = array_filter(
            $this->rates,
            function($rate) {
                return $rate->service_code != 'Hoy';
            }
        );
    }

    private function changeRatesEndingHour()
    {
        foreach ($this->rates as $rate) {
            if ($rate->service_code != 'Hoy') {
                continue;
            }
            $rate->ending_hour = '22:00';
        }
    }

    private function beforeSkydropTime()
    {
        $d = new \DateTime(\Skydrop\Configs::$openingTime);
        return time() <= $d->getTimestamp();
    }
}

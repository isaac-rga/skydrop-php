<?php

namespace Skydrop\ShippingRate\Rule;

class OpeningTime
{
    public $items;
    public $openingTime;
    private $now;

    public function __construct($items = [], $options = array())
    {
        $this->items = $items;
        if (!empty($options['openingTime'])) {
            $this->openingTime = $options['openingTime'];
        }
        $this->now = $this->getDateTimeNow();
    }

    public function call()
    {
        if ($this->afterOpeningHours()) {
            return true;
        }
        return $this->afterOpeningMins();
    }

    private function afterOpeningHours()
    {
        return $this->openingTime['hour'] < $this->now['hour'];
    }

    private function afterOpeningMins()
    {
        return $this->openingTime['hour'] == $this->now['hour'] &&
            $this->openingTime['min'] < $this->now['min'];
    }

    private function getDateTimeNow()
    {
        $d = new \DateTime();
        $d->setTimezone(new \DateTimeZone('America/Monterrey'));
        return ['hour' => (int)$d->format('H'), 'min' => (int)$d->format('i')];
    }
}

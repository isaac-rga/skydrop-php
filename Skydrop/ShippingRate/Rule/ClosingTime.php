<?php

namespace Skydrop\ShippingRate\Rule;

class ClosingTime
{
    public $items;
    public $closingTime;
    private $now;

    public function __construct($items = [], $options = array())
    {
        $this->items = $items;
        if (!empty($options['closingTime'])) {
            $this->closingTime = $options['closingTime'];
        }
        $this->now = $this->getDateTimeNow();
    }

    public function call()
    {
        if ($this->hoursLeft()) {
            return true;
        }
        return $this->minsLeft();
    }

    private function hoursLeft()
    {
        return $this->closingTime['hour'] > $this->now['hour'];
    }

    private function minsLeft()
    {
        return $this->closingTime['hour'] == $this->now['hour'] && 
            $this->closingTime['min'] > $this->now['min'];
    }

    private function getDateTimeNow()
    {
        $d = new \DateTime();
        $d->setTimezone(new \DateTimeZone('America/Monterrey'));
        return ['hour' => (int)$d->format('H'), 'min' => (int)$d->format('i')];
    }
}

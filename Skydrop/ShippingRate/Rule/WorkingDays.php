<?php

namespace Skydrop\ShippingRate\Rule;

class WorkingDays
{
    public $items;
    public $workingDays;

    public function __construct($items = [], $options = array())
    {
        $this->items = $items;
        if (!empty($options['workingDays'])) {
            $this->workingDays = $options['workingDays'];
        }
    }

    public function call()
    {
        return in_array($this->todayWday(), $this->workingDays);
    }

    private function todayWday()
    {
        $d = new \DateTime();
        return date('N', strtotime($d->format('D')));
    }
}

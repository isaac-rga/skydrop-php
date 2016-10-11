<?php

namespace Skydrop\Order;

abstract class AbstractServiceAdapter
{
    abstract public function serviceCode();
    abstract public function vehicleType();
    abstract public function scheduleDate();
    abstract public function startingTime();
    abstract public function endingTime();

    public function toJson()
    {
        return array(
            'service_code' => serviceCode(),
            'vehicle_type' => vehicleType(),
            'schedule_date' => scheduleDate(),
            'starting_hour' => startingTime(),
            'ending_hour' => endingTime()
        );
    }
}

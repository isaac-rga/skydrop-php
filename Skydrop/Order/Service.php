<?php

namespace Skydrop\Order;

class Service
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $serviceCode;
    private $vehicleType;
    private $scheduleDate;
    private $startingHour;
    private $endingHour;

    public function toHash()
    {
        return array(
            'service' => array(
                'service_code'  => $this->serviceCode,
                'vehicle_type'  => $this->vehicleType,
                'schedule_date' => $this->scheduleDate,
                'starting_hour' => $this->startingHour,
                'ending_hour'   => $this->endingHour,
            )
        );
    }
}

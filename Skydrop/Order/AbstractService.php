<?php

namespace Skydrop\Order;

abstract class AbstractService
{
   abstract public function serviceCode();
   abstract public function vehicleType();
   abstract public function scheduleDate();
   abstract public function startingHour();
   abstract public function endingHour();

   public function toHash()
   {
       return array(
           'service' => array(
               'service_code'  => $this->serviceCode(),
               'vehicle_type'  => $this->vehicleType(),
               'schedule_date' => $this->scheduleDate(),
               'starting_hour' => $this->startingHour(),
               'ending_hour'   => $this->endingHour(),
           )
       );
   }
}

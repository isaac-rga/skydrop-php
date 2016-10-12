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
               'service_code' => $service->serviceCode(),
               'vehicle_type' => $service->vehicleType(),
               'schedule_date' => $service->scheduleDate(),
               'starting_hour' => $service->startingHour(),
               'ending_hour' => $service->endingHour(),
           )
       );
   }
}

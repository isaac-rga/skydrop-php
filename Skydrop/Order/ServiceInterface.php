<?php

namespace Skydrop\Order;

interface ServiceInterface
{
    public function serviceCode();
    public function vehicleType();
    public function scheduleDate();
    public function startingHour();
    public function endingHour();
}

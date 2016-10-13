<?php

use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testToHash()
    {
        $stub = $this->getMock('\Skydrop\Order\AbstractService');
        $stub->setServiceCode('Hoy');
        $stub->setVehicleType('car');
        $stub->setScheduleDate('2016-10-10');
        $stub->setStartingHour('10:00');
        $stub->setEndingHour('22:00');

        $this->assertSame([
            'service' => [
               'service_code'  => 'Hoy',
               'vehicle_type'  => 'car',
               'schedule_date' => '2016-10-10',
               'starting_hour' => '10:00',
               'ending_hour'   => '22:00'
            ]
        ], $stub->toHash());
    }
}

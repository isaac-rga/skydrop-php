<?php

use PHPUnit\Framework\TestCase;

class AbstractServiceTest extends TestCase
{
    public function testToHash()
    {
        $stub = $this->getMockForAbstractClass('\Skydrop\Order\AbstractService');
        $stub->expects($this->any())
            ->method('serviceCode')
            ->will($this->returnValue('Hoy'));

        $stub->expects($this->any())
            ->method('vehicleType')
            ->will($this->returnValue('car'));

        $stub->expects($this->any())
            ->method('scheduleDate')
            ->will($this->returnValue('2016-10-10'));

        $stub->expects($this->any())
            ->method('startingHour')
            ->will($this->returnValue('10:00'));

        $stub->expects($this->any())
            ->method('endingHour')
            ->will($this->returnValue('22:00'));

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

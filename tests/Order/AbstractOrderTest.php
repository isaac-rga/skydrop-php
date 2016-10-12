<?php

use PHPUnit\Framework\TestCase;

class AbstractPackageTest extends TestCase
{
    public function testToHash()
    {
        // $stub = $this->getMockForAbstractClass('\Skydrop\Order\AbstractOrder')
        //     ->disableOriginalConstructor();
        $stub = $this->getMockBuilder('\Skydrop\Order\AbstractOrder')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();


        $stub->package = $this->getStdStub([
            'package' => [
                'cash_on_delivery' => 'true', 'cod_amount' => '100']])));

        $stub->service = $this->getStdStub([
            'service' => [
                'service_code'  => 'Hoy',
                'vehicle_type'  => 'car',
                'schedule_date' => '2016-10-10',
                'starting_hour' => '10:00',
                'ending_hour'   => '22:00'
            ]
        ])));

        $stub->pickup = $this->getStdStub([
            'pickup' => [
                'name' => 'juan rdz',
                'email' => 'juan@gmail.com',
                'street_name_and_number' => 'rio rosas 101',
                'municipality' => 'san pedro',
                'neighborhood' => 'del valle',
                'telephone' => '81149090',
            ] ])));

        $stub->delivery = $this->getStdStub();

        // $this->assertSame([
        //     'pickup' => [
        //     ],
        // ], $stub->toHash('pickup'));
    }

    private function getStdStub($array = [])
    {
        $std = $this->getMockBuilder('\StdClass')
                     ->disableOriginalConstructor()
                     ->getMockForAbstractClass();

        $std->expects($this->any())
            ->method('toHash')
            ->will($this->returnValue($array));

        return $std;
    }


    private function hash()
    {
        return [
            'pickup' => [
                'name' => 'juan rdz',
                'email' => 'juan@gmail.com',
                'street_name_and_number' => 'rio rosas 101',
                'municipality' => 'san pedro',
                'neighborhood' => 'del valle',
                'telephone' => '81149090',
            ]
        ];
    }
}

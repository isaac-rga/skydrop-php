<?php

use PHPUnit\Framework\TestCase;

class AbstractAddressTest extends TestCase
{
    public function testToHash()
    {
        $stub = $this->getMockForAbstractClass('\Skydrop\Order\AbstractAddress');
        $stub->expects($this->any())
            ->method('name')
            ->will($this->returnValue('juan rdz'));
        $stub->expects($this->any())
            ->method('email')
            ->will($this->returnValue('juan@gmail.com'));
        $stub->expects($this->any())
            ->method('streetNameAndNumber')
            ->will($this->returnValue('rio rosas 101'));
        $stub->expects($this->any())
            ->method('municipality')
            ->will($this->returnValue('san pedro'));
        $stub->expects($this->any())
            ->method('neighborhood')
            ->will($this->returnValue('del valle'));
        $stub->expects($this->any())
            ->method('telephone')
            ->will($this->returnValue('81149090'));

        $this->assertSame([
            'pickup' => [
                'name' => 'juan rdz',
                'email' => 'juan@gmail.com',
                'street_name_and_number' => 'rio rosas 101',
                'municipality' => 'san pedro',
                'neighborhood' => 'del valle',
                'telephone' => '81149090',
            ],
        ], $stub->toHash('pickup'));
    }
}

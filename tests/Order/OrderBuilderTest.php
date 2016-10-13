<?php

use PHPUnit\Framework\TestCase;

class Pickup {}
class Delivery {}
class Package {}
class Service {}

class OrderBuilderTest extends TestCase
{
    public function testClassInstantiating()
    {
        $stub = $this->getMockBuilder('\Skydrop\Order\OrderBuilder')
            ->setConstructorArgs([1])
            ->getMockForAbstractClass();

        $stub->expects($this->any())
            ->method('pickupClass')
            ->will($this->returnValue('\Pickup'));
        $stub->expects($this->any())
            ->method('deliveryClass')
            ->will($this->returnValue('\Delivery'));
        $stub->expects($this->any())
            ->method('serviceClass')
            ->will($this->returnValue('\Service'));
        $stub->expects($this->any())
            ->method('packageClass')
            ->will($this->returnValue('\Package'));

        $this->assertInstanceOf(Pickup::class, $stub->pickup);
        $this->assertInstanceOf(Delivery::class, $stub->delivery);
        $this->assertInstanceOf(Service::class, $stub->service);
        $this->assertInstanceOf(Package::class, $stub->package);
    }

    public function testToHash()
    {
        $stub = $this->getMockBuilder('\Skydrop\Order\OrderBuilder')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $stub->pickup = $this->getStdStub();
        $stub->delivery = $this->getStdStub();
        $stub->package = $this->getStdStub();
        $stub->service = $this->getStdStub();

        $expected = array_merge(
            $stub->pickup->toHash(),
            $stub->delivery->toHash(),
            $stub->package->toHash(),
            $stub->service->toHash()
        );

        $this->assertSame($stub->toHash(), $expected);
    }

    private function getStdStub()
    {
        $std = $this->getMockBuilder('StdStub')
            ->setMethods(['toHash'])
            ->getMock();

        $array = [
            'std' => [
                'std' => 'std',
            ]
        ];
        $std->expects($this->any())
            ->method('toHash')
            ->will($this->returnValue($array));

        return $std;
    }
}

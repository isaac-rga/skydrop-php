<?php

use PHPUnit\Framework\TestCase;

class AbstractPackageTest extends TestCase
{
    public function testToHash()
    {
        $stub = $this->getMockBuilder('\Skydrop\Order\AbstractOrder')
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

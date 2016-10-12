<?php

use PHPUnit\Framework\TestCase;

class AbstractPackageTest extends TestCase
{
    public function testToHashReturnsEmptyArrayWhenNoCodNeeded()
    {
        $stub = $this->getMockForAbstractClass('\Skydrop\Order\AbstractPackage');
        $this->assertSame(array(), $stub->toHash());
    }

    public function testToHashReturnsHashWhenCodNeeded()
    {
        $stub = $this->getMockForAbstractClass('\Skydrop\Order\AbstractPackage');
        $stub->expects($this->any())
            ->method( 'needsCashOnDelivery' )
            ->will($this->returnValue(true));
        $stub->expects($this->any())
            ->method('codAmount')
            ->will($this->returnValue(100));

        $this->assertSame([
            'package' => [
                'cash_on_delivery' => 'true',
                'cod_amount' => '100',
            ],
        ], $stub->toHash());
    }
}

<?php

use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    public function testToHashReturnsHashWhenCodNeeded()
    {
        $stub = $this->getMock('\Skydrop\Order\AbstractPackage');
        $stub->setCodAmount(100);

        $this->assertSame([
            'package' => [
                'cash_on_delivery' => 'true',
                'cod_amount' => '100',
            ],
        ], $stub->toHash());
    }
}

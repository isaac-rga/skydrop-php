<?php

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function setUp()
    {
        \Skydrop\Configs::setApiKey('abcdefghijk');
        \Skydrop\Configs::setEnv('staging');
        \VCR\VCR::configure()->setCassettePath(getcwd().'/tests/VCR');
        \VCR\VCR::turnOn();
    }

    public function testCallReturnSuccess()
    {
        \VCR\VCR::insertCassette('create_order_success');

        $order = $this->getValidOrder();
        $this->assertTrue(\Skydrop\Order\Create::call($order));

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    public function testCallReturnFail()
    {
        \VCR\VCR::insertCassette('create_order_fail');

        $order = $this->getInvalidOrder();
        $this->assertTrue(\Skydrop\Order\Create::call($order));

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    private function getInvalidOrder()
    {
    }

    private function getValidOrder()
    {
    }
}

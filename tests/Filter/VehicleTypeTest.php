<?php
use PHPUnit\Framework\TestCase;

class OnePerServiceTest extends TestCase
{
    public function testReturnCarTypeRates()
    {
        $json_rates = file_get_contents(__DIR__.'/../fixtures/rates.json');
        $rates = json_decode($json_rates)->rates;
        $klass = new \Skydrop\ShippingRate\Filter\VehicleType(
            $rates, ['vehicleTypes' => ['car']]
        );
        $newRates = $klass->call();

        $this->assertEquals(count($newRates), 8);
    }

    public function testReturnScooterTypeRates()
    {
        $json_rates = file_get_contents(__DIR__.'/../fixtures/rates.json');
        $rates = json_decode($json_rates)->rates;
        $klass = new \Skydrop\ShippingRate\Filter\VehicleType(
            $rates, ['vehicleTypes' => ['scooter']]
        );
        $newRates = $klass->call();

        $this->assertEquals(count($newRates), 1);
    }
}

<?php
use PHPUnit\Framework\TestCase;

class OnePerServiceTest extends TestCase
{
    public function testSetApiKey()
    {
        $json_rates = file_get_contents(__DIR__.'/../fixtures/rates.json');
        $rates = json_decode($json_rates)->rates;
        // var_dump($rates);
        $klass = new \Skydrop\ShippingRate\Filter\OnePerService(
            $rates, ['serviceTypes' => ['Hoy']]
        );
        $newRates = $klass->call();

        $this->assertEquals(count($newRates), 1);
    }
}

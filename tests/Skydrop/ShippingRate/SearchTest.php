<?php
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    protected function setUp()
    {
        $json_rates = file_get_contents(__DIR__.'/../../fixtures/rates.json');
        $this->rates = json_decode($json_rates);
    }

    public function testCallWithFilters()
    {
        $filters = [
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Filter\\OnePerService',
                'options' => [
                    'serviceTypes' => ['Hoy']
                ]
            ),
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Filter\\VehicleType',
                'options' => [
                    'vehicleTypes' => ['car']
                ]
            )
        ];

        \Skydrop\Configs::setApiKey('abcdefghijk');
        \Skydrop\Configs::setEnv('staging');
        \Skydrop\Configs::setFilters($filters);

        $search = new \Skydrop\ShippingRate\Search(
            $this->rates->rate->items, $this->rates
        );

        \VCR\VCR::configure()->setCassettePath(getcwd().'/tests/VCR');
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('shipping_rates');

        $result = $search->call();
        foreach ($result as $rate) {
            $this->assertEquals($rate->service_code, 'Hoy');
            $this->assertEquals($rate->vehicle_type, 'car');
        }

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }
}

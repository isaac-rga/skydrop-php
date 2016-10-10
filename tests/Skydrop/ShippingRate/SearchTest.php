<?php
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    protected function setUp()
    {
        \Skydrop\Configs::setApiKey('abcdefghijk');
        \Skydrop\Configs::setEnv('staging');

        $json_rates = file_get_contents(getcwd().'/tests/fixtures/rates.json');
        $this->rates = json_decode($json_rates);
    }

    public function testCallWithFilters()
    {
        \Skydrop\Configs::setFilters($this->getFilters());

        $search = new \Skydrop\ShippingRate\Search(
            $this->rates->rate->items, $this->rates
        );

        \VCR\VCR::configure()->setCassettePath(getcwd().'/tests/VCR');
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('shipping_rates');

        $result = $search->call();
        $this->assertEquals(count($result), 1);
        foreach ($result as $rate) {
            $this->assertEquals($rate->service_code, 'Hoy');
            $this->assertEquals($rate->vehicle_type, 'car');
        }

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    public function testCallWithModifiers()
    {
        \Skydrop\Configs::setFilters($this->getFilters());
        \Skydrop\Configs::setModifiers($this->getModifiers());

        $search = new \Skydrop\ShippingRate\Search(
            $this->rates->rate->items, $this->rates
        );

        \VCR\VCR::configure()->setCassettePath(getcwd().'/tests/VCR');
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('shipping_rates');

        $result = $search->call();
        $name = 'Skydrop - Mismo Dia, te llega antes de las 10:00 pm';
        $this->assertEquals(count($result), 1);
        foreach ($result as $rate) {
            $code = json_encode([
                'service_code' => 'Hoy',
                'vehicle_type' => $rate->vehicle_type,
                'starting_hour' => $rate->starting_hour,
                'ending_hour' => $rate->ending_hour
            ]);
            $this->assertEquals($rate->service_code, $code);
            $this->assertEquals($rate->service_name, $name);
            $this->assertEquals($rate->vehicle_type, 'car');
        }

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    public function testCallWithRules()
    {
        \Skydrop\Configs::setFilters($this->getFilters());
        \Skydrop\Configs::setModifiers($this->getModifiers());
        \Skydrop\Configs::setRules($this->getRules());

        $search = new \Skydrop\ShippingRate\Search(
            $this->rates->rate->items, $this->rates
        );

        \VCR\VCR::configure()->setCassettePath(getcwd().'/tests/VCR');
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('shipping_rates');

        $result = $search->call();
        $this->assertEquals(count($result), 1);
        foreach ($result as $rate) {
            $code = json_encode([
                'service_code' => 'Hoy',
                'vehicle_type' => $rate->vehicle_type,
                'starting_hour' => $rate->starting_hour,
                'ending_hour' => $rate->ending_hour
            ]);
            $this->assertEquals($rate->service_code, $code);
            $this->assertEquals($rate->vehicle_type, 'car');
        }

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    private function getFilters()
    {
        return [
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
    }

    private function getModifiers()
    {
        return [
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\ServiceName',
                'options' => []
            ),
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\CodeEncoder',
                'options' => []
            )
        ];
    }

    private function getRules()
    {
        return [
        ];
    }
}

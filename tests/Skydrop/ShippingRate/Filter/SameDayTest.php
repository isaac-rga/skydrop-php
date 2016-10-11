<?php
use PHPUnit\Framework\TestCase;

class SameDayTest extends TestCase
{
    public function testRejectSameDay()
    {
        date_default_timezone_set('America/Monterrey');
        $new_time = mktime(22, 0, 0, 10, 8, 2016);
        timecop_freeze($new_time);

        $result = $this->sameDay->call();
        foreach ($result as $rate) {
            $this->assertNotEquals('Hoy', $rate->service_code);
        }

        timecop_return();
    }

    public function testIncludeSameDay()
    {
        date_default_timezone_set('America/Monterrey');
        $new_time = mktime(12, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);

        $result = $this->sameDay->call();
        $this->assertEquals('Hoy', $result[4]->service_code);

        timecop_return();
    }

    public function testChangeEndingHour()
    {
        date_default_timezone_set('America/Monterrey');
        $new_time = mktime(2, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);

        $result = $this->sameDay->call();
        $this->assertEquals('22:00', $result[4]->ending_hour);

        timecop_return();
    }

    protected function setUp()
    {
        $json_shipping_rates = file_get_contents(getcwd().'/tests/fixtures/shipping_rates.json');
        $shipping_rates = json_decode($json_shipping_rates);

        date_default_timezone_set('America/Monterrey');
        $defaultOptions = [
            'workingDays' => [1,2,3,4,5],
            'openingTime' => [ 'hour' => 9, 'min', 30 ],
            'closingTime' => [ 'hour' => 21, 'min', 30 ]
        ];
        $serviceTime = new \Skydrop\ShippingRate\Service\ShopServiceTime(
            $defaultOptions
        );

        $this->sameDay = new \Skydrop\ShippingRate\Filter\SameDay(
            $shipping_rates,
            [ 'shopServiceTime' => $serviceTime ]
        );
    }
}

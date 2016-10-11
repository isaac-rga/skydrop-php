<?php
use PHPUnit\Framework\TestCase;

class NextDayTest extends TestCase
{
    public function testRejectNextDay()
    {
        date_default_timezone_set('America/Monterrey');
        $new_time = mktime(22, 0, 0, 10, 8, 2016);
        timecop_freeze($new_time);

        $result = $this->nextDay->call();
        foreach ($result as $rate) {
            $this->assertNotEquals('next_day', $rate->service_code);
        }

        timecop_return();
    }

    public function testIncludeNextDay()
    {
        date_default_timezone_set('America/Monterrey');
        $new_time = mktime(12, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);

        $result = $this->nextDay->call();
        $this->assertEquals('next_day', $result[12]->service_code);

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

        $this->nextDay = new \Skydrop\ShippingRate\Filter\NextDay(
            $shipping_rates, [ 'shopServiceTime' => $serviceTime ]
        );
    }
}

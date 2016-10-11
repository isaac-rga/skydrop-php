<?php
use PHPUnit\Framework\TestCase;

class ShopServiceTimeTest extends TestCase
{
    protected function setUp()
    {
        date_default_timezone_set('America/Monterrey');
        $this->defaultOptions = [
            'workingDays' => [1,2,3,4,5],
            'openingTime' => [ 'hour' => 9, 'min', 30 ],
            'closingTime' => [ 'hour' => 21, 'min', 30 ]
        ];
        $this->serviceTime = new \Skydrop\ShippingRate\Service\ShopServiceTime(
            $this->defaultOptions
        );
    }

    public function testAvailableForSameDay()
    {
        $new_time = mktime(1, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);
        $this->assertTrue($this->serviceTime->availableFor('same_day'));
    }

    public function testNotAvailableForSameDay()
    {
        $new_time = mktime(22, 0, 0, 10, 8, 2016);
        timecop_freeze($new_time);
        $this->assertNotTrue($this->serviceTime->availableFor('same_day'));
    }

    public function testAvailableForNextDay()
    {
        $new_time = mktime(1, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);
        $this->assertTrue($this->serviceTime->availableFor('next_day'));
    }

    public function testNotAvailableForNextDay()
    {
        $new_time = mktime(2, 0, 0, 10, 8, 2016);
        timecop_freeze($new_time);
        $this->assertNotTrue($this->serviceTime->availableFor('next_day'));
    }

    public function testAvailableForEExps()
    {
        $new_time = mktime(12, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);
        $this->assertTrue($this->serviceTime->availableFor('express'));
    }

    public function testNotAvailableForEExps()
    {
        $new_time = mktime(22, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);
        $this->assertNotTrue($this->serviceTime->availableFor('express'));
    }
}

<?php
use PHPUnit\Framework\TestCase;

class WorkingDaysTest extends TestCase
{
    public function testInWorkingDays()
    {
        $new_time = mktime(12, 0, 0, 10, 10, 2016);
        timecop_freeze($new_time);
        $workingDays = new \Skydrop\ShippingRate\Rule\WorkingDays(
            [], [ 'workingDays' => [1,2,3,4,5] ]
        );
        $this->assertTrue($workingDays->call());
    }

    public function testNotWorkingDays()
    {
        $new_time = mktime(12, 0, 0, 9, 10, 2016);
        timecop_freeze($new_time);
        $workingDays = new \Skydrop\ShippingRate\Rule\WorkingDays(
            [], [ 'workingDays' => [1,2,3,4,5] ]
        );
        $this->assertNotTrue($workingDays->call());
    }
}

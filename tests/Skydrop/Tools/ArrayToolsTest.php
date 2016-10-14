<?php
use PHPUnit\Framework\TestCase;

class ConfigsTest extends TestCase
{
    public function testMergeArrayOfObjectsByKey()
    {
        $defaultArray = [
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\ServiceName',
                'options' => []
            ),
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\CodeEncoder',
                'options' => []
            )
        ];

        $myArray = [
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\ServiceName',
                'options' => [ 'serviceNames' => ['same_day' => 'here is my custom message'] ]
            )
        ];

        $expectedArray = [
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\ServiceName',
                'options' => [ 'serviceNames' => ['same_day' => 'here is my custom message'] ]
            ),
            (object)array(
                'klass' => '\\Skydrop\\ShippingRate\\Modifier\\CodeEncoder',
                'options' => []
            )
        ];

        $arrayTool = new \Skydrop\Tools\ArrayTools($myArray);
        $arrayTool->mergeArrayOfObjectsByKey($defaultArray, 'klass');
        $this->assertSame($expectedArray, $arrayTool->getIterator());
    }
}

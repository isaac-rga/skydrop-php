<?php
use PHPUnit\Framework\TestCase;

class ConfigsTest extends TestCase
{
    public function testSetApiKey()
    {
        $apiKey = 'abcdefg';
        \Skydrop\Configs::setApiKey('abcdefg');
        $actual = \Skydrop\Configs::$apiKey;

        $this->assertEquals($apiKey, $actual);
    }

    public function testSetFilters()
    {
        $filters = ['Filter\\OnePerService'];
        \Skydrop\Configs::setFilters($filters);
        $actual = \Skydrop\Configs::$filters;

        $this->assertEquals($filters, $actual);
    }
}

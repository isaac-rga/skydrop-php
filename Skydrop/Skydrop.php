<?php

namespace Skydrop;

abstract class Skydrop
{
    const PRODUCTION_URL = 'http://www.skydrop.com.mx/api/v2';
    const STAGING_URL = 'http://54.191.139.107/api/v2';
    public static $apiKey;
    public static $env = 'production';

    public static function setApiKey($newApiKey)
    {
        self::$apiKey = $newApiKey;
    }

    public static function setEnv($newEnv)
    {
        self::$env = $newEnv;
    }

    public static function baseURL()
    {
        if (self::$env == 'production') {
            return self::PRODUCTION_URL;
        }

        return self::STAGING_URL;
    }
}

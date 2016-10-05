<?php

require __DIR__.'/../vendor/autoload.php';

if (!class_exists('GuzzleHttp\Client')) {
    throw new Exception('SkydropAPI needs the GuzzleHttp PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('SkydropAPI needs the JSON PHP extension.');
}

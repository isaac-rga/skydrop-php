<?php

namespace Skydrop;

class ShippingRate
{
    const ALL_URL  = '/shipping_rates';
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Requestor();
    }

    public static function all($params)
    {
        return $this->httpClient->request('POST', SELF::ALL_URL, $params);
    }
}

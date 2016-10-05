<?php

namespace SkydropAPI;

class ShippingRate extends SkydropAbstract
{
    const GET_URL   = '/shipping_rates';

    public function get($api_key, $params)
    {
        $url = self::GET_URL;
        $res = $this->request($api_key, 'POST', $url, $params);
        return $res;
    }
}

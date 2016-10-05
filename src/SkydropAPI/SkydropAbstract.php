<?php

namespace SkydropAPI;

class SkydropAbstract
{
    protected function request($api_key, $method, $url, $params)
    {
        $requester = new Requester(
            array(
                'api_key' => $api_key,
                'method' => $method,
                'url' => $url,
                'params' => $params
            )
        );
        $res = $requester->makeRequest();
        return $res;
    }
}

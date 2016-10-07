<?php

namespace SkydropAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class Requestor
{
    public $apiKey;
    private $httpClient;
    private $headers;

    public function __construct()
    {
        $this->apiKey = Skydrop::$apiKey;
    }

    public function request($method, $url, $params = [])
    {
        $httpClient = $this->getHttpClient();

        $res = $httpClient->request(
            $method,
            $this->getURL($url),
            ['json' => $params]
        );

        return json_decode($res->getBody());
    }

    private function getURL($resourceURL)
    {
        return "{Skydrop::$baseURL()}{$resourceURL}";
    }

    private function getHeaders()
    {
        if (isset($this->headers)) {
            return $this->headers;
        }

        $this->headers = [
            'Authorization' => $this->apiKey,
        ];

        return $this->headers;
    }

    private function getHttpClient()
    {
        if (isset($this->httpClient)) {
            return $this->httpClient;
        }

        return $this->httpClient = new \GuzzleHttp\Client([
            'headers' => $this->getHeaders()
        ]);
    }
}

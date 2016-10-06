<?php

namespace SkydropAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class Requester
{
    const PRODUCTION_URL = 'http://www.skydrop.com.mx/api/v2';

    const STAGING_URL    = 'http://54.191.139.107/';

    const API_VERSION    = 'api/v2';

    private $api_key = '';

    private $method = 'GET';

    private $url = '';

    private $params = array();

    public function __construct(array $args)
    {
        $this->method            = $args['method'];
        $this->url               = self::API_VERSION.$args['url'];
        $this->params            = $args['params'];
        $this->params['api_key'] = $args['api_key'];
        $this->client            = new Client(['base_uri' => self::STAGING_URL]);
    }

    public function makeRequest()
    {
        try {
            $response = $this->client->request(
                strtoupper($this->method),
                $this->url,
                ['json' => $this->params]
            );
            return json_decode($response->getBody());
        } catch (RequestException $e) {
            switch ($e->getResponse()->getStatusCode()) {
            case 404:
                return new Exceptions\NotFoundException($e);
                break;
            case 401:
                return new Exceptions\UnauthorizedException($e);
                break;
            case 422:
                // return new Exceptions\UnauthorizedException($e);
                var_dump($e->getResponse());
                break;
            default:
                var_dump($e->getResponse());
                break;
            }
        }
    }
}

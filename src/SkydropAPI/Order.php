<?php

namespace SkydropAPI;

class Order extends SkydropAbstract
{
    const GET_URL    = '/orders';

    const FIND_URL   = '/orders/:id';

    const CREATE_URL = '/orders';

    const SAVE_URL   = '/orders/:id';

    private $api_key = '';

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    public function get()
    {
        $url = self::GET_URL;
        $res = $this->request($this->api_key, 'GET', $url, array());
        return $res->orders;
    }

    public function find($id)
    {
        $url = str_replace(":id", $id, self::FIND_URL);
        $res = $this->request($this->api_key, 'GET', $url, array());
        return $res;
    }

    public function create($params)
    {
        $url = self::CREATE_URL;
        $res = $this->request($this->api_key, 'POST', $url, $params);
        return $res;
    }

    public function save($id, $params)
    {
        $url = str_replace(":id", $id, self::SAVE_URL);
        $res = $this->request($this->api_key, 'PUT', $url, $params);
        return $res;
    }
}


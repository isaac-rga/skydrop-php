<?php

namespace Skydrop;

class User
{
    const FIND_URL   = '/users';
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Requestor();
    }

    public function find()
    {
        return $this->httpClient->request('GET', self::FIND_URL);
    }
}

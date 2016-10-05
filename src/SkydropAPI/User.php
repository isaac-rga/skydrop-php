<?php

namespace SkydropAPI;

class User extends SkydropAbstract
{
    const FIND_URL   = '/users';

    public function find($api_key)
    {
        $url = self::FIND_URL;
        $res = $this->request($api_key, 'GET', $url, array());
        return $res;
    }
}

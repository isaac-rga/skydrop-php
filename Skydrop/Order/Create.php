<?php

namespace Skydrop\Order;

class Create
{
    public static function call($orderBuilder)
    {
        try {
            $order = new \Skydrop\API\Order();
            $order->create($orderBuilder->toHash());
            return true;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return false;
        }
    }
}

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
        } catch (Exception $e) {
            return false;
        }
    }
}

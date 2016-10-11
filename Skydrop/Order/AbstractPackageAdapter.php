<?php

namespace Skydrop\Order;

abstract class AbstractPackageAdapter
{
    abstract public function codAmount();

    public function toJson()
    {
        return array(
            'cash_on_delivery' => cashOnDelivery(),
            'cod_amount' => codAmount()
        );
    }

    public function cashOnDelivery()
    {
        return true;
    }
}

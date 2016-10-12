<?php

namespace Skydrop\Order;

abstract class AbstractPackage
{
    abstract public function codAmount();
    abstract public function cashOnDelivery();

    public function toJson()
    {
        if (needsCashOnDelivery()) {
            return array(
                'package' => array(
                    'cash_on_delivery' => $this->cashOnDelivery(),
                    'cod_amount' => $this->codAmount(),
                )
            );
        }

        return array();
    }

    protected function needsCashOnDelivery()
    {
        return false;
    }
}

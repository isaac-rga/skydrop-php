<?php

namespace Skydrop\Order;

abstract class AbstractPackage
{
    abstract public function codAmount();
    abstract public function needsCashOnDelivery();

    public function toHash()
    {
        if ($this->needsCashOnDelivery()) {
            return array(
                'package' => array(
                    'cash_on_delivery' => 'true',
                    'cod_amount' => "{$this->codAmount()}",
                )
            );
        }

        return array();
    }
}

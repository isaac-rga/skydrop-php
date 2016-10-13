<?php

namespace Skydrop\Order;

class Package
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $codAmount;

    public function __construct($args=[])
    {
        $this->codAmount = array_key_exists('codAmount', $args) ? $args['codAmount'] : '';
    }

    public function toHash()
    {
        return array(
            'package' => array(
                'cash_on_delivery' => 'true',
                'cod_amount' => "{$this->codAmount}",
            )
        );
    }
}

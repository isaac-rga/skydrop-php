<?php

namespace Skydrop\ShippingRate;

class ShippingRate
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    protected $args;
    private   $origin;
    private   $destination;
    private   $items;

    public function toHash()
    {
        return array(
            'rate' => array(
                $this->origin->toHash('origin'),
                $this->destination->toHash('destination')
            )
        );
    }
}

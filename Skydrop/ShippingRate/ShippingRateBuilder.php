<?php

namespace Skydrop\ShippingRate;

class ShippingRateBuilder
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private   $origin;
    private   $destination;
    private   $items;

    public function __construct($args=[])
    {
        $this->origin      = $this->getFromArray('origin', $args, '');
        $this->destination = $this->getFromArray('destination', $args, '');
    }

    public function toHash()
    {
        return array(
            'rate' => array_merge(
                $this->origin->toHash('origin'),
                $this->destination->toHash('destination')
            )
        );
    }
}

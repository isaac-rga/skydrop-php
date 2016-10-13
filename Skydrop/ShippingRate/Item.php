<?php

namespace Skydrop\ShippingRate;

class Item
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $name;
    private $sku;
    private $quantity;
    private $price;
}

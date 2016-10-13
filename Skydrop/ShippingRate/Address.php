<?php

namespace Skydrop\ShippingRate;

class Address
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $name;
    private $phone;
    private $address1;
    private $address2;
    private $city;
    private $province;
    private $zipCode;
    private $country;

    public function toHash($rootKey)
    {
        return array(
            "{$rootKey}" => array(
                'name'        => $this->name,
                'phone'       => $this->phone,
                'address1'    => $this->address1,
                'address2'    => $this->address2,
                'city'        => $this->city,
                'province'    => $this->province,
                'postal_code' => $this->zipCode,
                'country'     => $this->country
            )
        );
    }
}

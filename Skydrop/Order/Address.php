<?php

namespace Skydrop\Order;

class Address
{
    use \Skydrop\Traits\GettersAndSettersTrait;

    private $name;
    private $email;
    private $streetNameAndNumber;
    private $municipality;
    private $neighborhood;
    private $telephone;

    public function toHash($rootKey)
    {
        return array(
            "{$rootKey}" => array(
                'name' => $this->name,
                'email' => $this->email,
                'street_name_and_number' => $this->streetNameAndNumber,
                'municipality' => $this->municipality,
                'neighborhood' => $this->neighborhood,
                'telephone' => $this->telephone
            )
        );
    }
}

<?php

namespace Skydrop\Order;

abstract class AbstractAddressAdapter
{
    abstract public function name();
    abstract public function email();
    abstract public function streetNameAndNumber();
    abstract public function municipality();
    abstract public function neighborhood();
    abstract public function telephone();

    public function toJson()
    {
        return array(
            'name' => $this->name(),
            'email' => $this->email(),
            'streetNameAndNumber' => $this->streetNameAndNumber(),
            'municipality' => $this->municipality(),
            'neighborhood' => $this->neighborhood(),
            'telephone' => $this->telephone(),
        );
    }
}

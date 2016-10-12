<?php

namespace Skydrop\Order;

interface AddressInterface
{
    public function name();
    public function email();
    public function streetNameAndNumber();
    public function municipality();
    public function neighborhood();
    public function telephone();
}

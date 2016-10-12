<?php

namespace Skydrop\Order;

abstract class AbstractAddress
{
   abstract public function name();
   abstract public function email();
   abstract public function streetNameAndNumber();
   abstract public function municipality();
   abstract public function neighborhood();
   abstract public function telephone();

   public function toHash($rootKey)
   {
       return array(
           "{$rootKey}" => array(
               'name' => $this->name(),
               'email' => $this->email(),
               'street_name_and_number' => $this->streetNameAndNumber(),
               'municipality' => $this->municipality(),
               'neighborhood' => $this->neighborhood(),
               'telephone' => $this->telephone(),)
           );
   }
}

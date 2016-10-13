<?php

namespace Skydrop\Traits;

trait GettersAndSettersTrait
{
   function __call($method, $params) {

       $var = lcfirst(substr($method, 3));

       if (substr($method, 0, 3) == 'get') {
           return $this->$var;
       }

       if (substr($method, 0, 3) == 'set') {
           $this->$var = $params[0];
       }
   }
}

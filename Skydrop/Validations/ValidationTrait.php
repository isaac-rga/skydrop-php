<?php

namespace Skydrop\Validations;

use Respect\Validation\Exceptions\NestedValidationException;

trait ValidationTrait
{
    public function validate()
    {
        if (!$this->validator->validate($this)) {
            try {
                $this->validator->assert('Validations Error!');
            } catch(NestedValidationException $exception) {
                throw new \Exception($exception->getFullMessage());
                // print_r($exception->getMessages());
            }
        }
    }
}

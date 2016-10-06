<?php

namespace SkydropAPI\Exceptions;

class UnauthorizedException
{
    public $errors = [];

    public $fullMessages = [];

    public $statusCode = [];

    public function __construct($e)
    {
        $this->statusCode = $e->getResponse()->getStatusCode();
        $this->errors = [['user' => $e->getResponse()->getReasonPhrase()]];
        $this->fullMessages = [
            ["User {$e->getResponse()->getReasonPhrase()}"]
        ];
    }
}

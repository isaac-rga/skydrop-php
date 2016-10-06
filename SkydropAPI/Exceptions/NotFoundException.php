<?php

namespace SkydropAPI\Exceptions;

class NotFoundException
{
    public $errors = [];

    public $fullMessages = [];

    public $statusCode = [];

    public function __construct($e)
    {
        $this->statusCode = $e->getResponse()->getStatusCode();
        $this->errors = [['page' => $e->getResponse()->getReasonPhrase()]];
        $this->fullMessages = [
            ["Page {$e->getResponse()->getReasonPhrase()}"]
        ];
    }
}

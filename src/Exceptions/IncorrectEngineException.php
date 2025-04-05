<?php

namespace StefanGalescu\Heroicons\Exceptions;

use Exception;

class IncorrectEngineException extends Exception
{
    protected $message;

    public function __construct()
    {
        $this->message = 'The `stefangalescu/statamic-heroicons` addon requires the `runtime` Antlers engine.';
    }
}

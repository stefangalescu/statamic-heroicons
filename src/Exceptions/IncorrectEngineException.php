<?php

namespace StefanGalescu\Heroicons\Exceptions;

use Exception;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use StefanGalescu\Heroicons\Exceptions\Solutions\IncorrectEngineSolution;

class IncorrectEngineException extends Exception implements ProvidesSolution
{
    protected $message;

    public function __construct()
    {
        $this->message = 'The `stefan-galescu/statamic-heroicons` addon requires the `runtime` Antlers engine.';
    }

    public function getSolution(): Solution
    {
        return new IncorrectEngineSolution();
    }
}

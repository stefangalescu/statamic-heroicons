<?php

declare(strict_types=1);

namespace StefanGalescu\Heroicons;

use Statamic\Providers\AddonServiceProvider;
use StefanGalescu\Heroicons\Exceptions\IncorrectEngineException;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        \StefanGalescu\Heroicons\Tags\Heroicon::class,
    ];

    public function bootAddon()
    {
        $antlersEngine = config('statamic.antlers.version');

        if (! is_null($antlersEngine) && $antlersEngine !== 'runtime') {
            throw new IncorrectEngineException;
        }
    }
}

<?php

namespace StefanGalescu\Heroicons;

use Statamic\Providers\AddonServiceProvider;
use StefanGalescu\Heroicons\Exceptions\IncorrectEngineException;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        \StefanGalescu\Heroicons\Tags\Heroicon::class,
    ];

    public function register(): void
    {
        $antlersVersion = config('statamic.antlers.version');

        if ($antlersVersion !== 'runtime') {
            throw new IncorrectEngineException();
        }

        $this->registerConfig();
    }

    public function bootAddon()
    {
        //
    }

    public function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/statamic-heroicons.php', 'statamic-heroicons');
    }
}

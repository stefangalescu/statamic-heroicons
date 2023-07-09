<?php

namespace StefanGalescu\Heroicons;

use Statamic\Providers\AddonServiceProvider;
use StefanGalescu\Heroicons\Exceptions\IncorrectEngineException;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        \StefanGalescu\Heroicons\Tags\Heroicon::class,
    ];

    public function register()
    {
        $this->registerAddonConfig();
    }

    public function bootAddon()
    {
        $antlersEngine = config('statamic.antlers.version');

        if ($antlersEngine !== 'runtime') {
            throw new IncorrectEngineException();
        }
    }

    protected function registerAddonConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/heroicons.php', 'statamic.heroicons');

        $this->publishes([
            __DIR__.'/../config/heroicons.php' => config_path('statamic/heroicons.php'),
        ], 'statamic-heroicons-config');

        return $this;
    }
}

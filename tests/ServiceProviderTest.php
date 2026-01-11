<?php

declare(strict_types=1);

namespace StefanGalescu\Heroicons\Tests;

use StefanGalescu\Heroicons\Exceptions\IncorrectEngineException;
use StefanGalescu\Heroicons\ServiceProvider;

class ServiceProviderTest extends TestCase
{
    public function test_throws_exception_when_antlers_engine_is_not_runtime(): void
    {
        config()->set('statamic.antlers.version', 'regex');

        $this->expectException(IncorrectEngineException::class);
        $this->expectExceptionMessage('The `stefangalescu/statamic-heroicons` addon requires the `runtime` Antlers engine.');

        $provider = new ServiceProvider($this->app);
        $provider->bootAddon();
    }

    public function test_does_not_throw_when_antlers_engine_is_runtime(): void
    {
        config()->set('statamic.antlers.version', 'runtime');

        $provider = new ServiceProvider($this->app);
        $provider->bootAddon();

        $this->assertTrue(true); // No exception thrown
    }

    public function test_does_not_throw_when_antlers_engine_is_null(): void
    {
        config()->set('statamic.antlers.version', null);

        $provider = new ServiceProvider($this->app);
        $provider->bootAddon();

        $this->assertTrue(true); // No exception thrown
    }
}

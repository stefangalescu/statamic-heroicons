<!-- statamic:hide -->

![Banner](banner.png)

## Statamic Heroicons

<!-- /statamic:hide -->

A package to easily make use of Heroicons in your Statamic sites. This package is a wrapper over [`blade-ui-kit/blade-heroicons`](https://github.com/blade-ui-kit/blade-heroicons).

For a full list of available icons see [the SVG directory](https://github.com/blade-ui-kit/blade-heroicons/tree/main/resources/svg) from the [`blade-ui-kit/blade-heroicons`](https://github.com/blade-ui-kit/blade-heroicons) repository or preview them at [heroicons.com](https://heroicons.com/). Heroicons are originally developed by [Steve Schoger](https://twitter.com/steveschoger) and [Adam Wathan](https://twitter.com/adamwathan).

## Requirements

- PHP 7.4 or higher
- Laravel 8.0 or higher
- Statamic 3.3 or higher

Apart from the requirements above, it is required that you use Statamic's new Runtime Antlers engine. Read more about it and how to enable it in [Statamic's official documentation](https://statamic.dev/new-antlers-parser#about).

## Installation

First, require `statamic-heroicons` as a Composer dependency:

```
composer require stefan-galescu/statamic-heroicons
```

Optionally, publish the config file and anything else, with this command:

```
php artisan vendor:publish --tag="stefan-galescu/statamic-heroicons"
```

If you need additional options, you can also publish the [blade-ui-kit/blade-heroicons](https://github.com/blade-ui-kit/blade-heroicons) config. Make sure to also look into the [icon caching](https://github.com/blade-ui-kit/blade-icons#caching) feature provided by [`blade-ui-kit/blade-heroicons`](https://github.com/blade-ui-kit/blade-heroicons).

## Usage

```antlers
{{ heroicon:solid:menu }}

{{ heroicon:outline:menu }}

{{ heroicon:outline:menu class="text-gray-500" }}

{{ heroicon :variant="variant" :icon="icon" }}
```

Apart from a couple of reserved prop names (`as`, `scope`, `variant`, `icon`), any prop you pass (e.g. `class`, `style`, `aria-hidden` etc.) will be added to the root SVG element.

The `{{ heroicon }}` also allows you to pass dynamically binded attributes like you would use in a JavaScript framework like Alpine.js. The only gotcha is that you cannot use the shorthand syntax `:class="condition ? 'text-red-500' : 'text-green-500'"`. You must use the full binding (e.g. `x-bind:class`, `v-bind:class`). Example:

```antlers
{{ heroicon:solid:menu class="w-5 h-5" title="Main menu" }}
```

## Documentation

### Configuration

This addon provides its own configuration file. You can use this to configure the API keys and other options.

```php
return [
    //
];
```

## Sponsor Stefan

This addon is open-source, meaning anyone can use this addon in their sites for **free**!

However, maintaining and developing new features for open-source projects can take quite a bit of time. If you're using `statamic-heroicons in` your production environment, please [consider sponsoring me](https://github.com/sponsors/stefan-galescu) for a couple dollars a month.

## Security

Only the latest version of `statamic-heroicons` will receive security updates if a vulnerability is found.

If you discover a security vulnerability, please report it to Stefan Galescu straight away, [via email](mailto:stefan.galescu@gmail.com). Please don't report security issues through GitHub Issues.

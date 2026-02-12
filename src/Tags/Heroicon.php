<?php

declare(strict_types=1);

namespace StefanGalescu\Heroicons\Tags;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Statamic\Tags\Tags;

class Heroicon extends Tags
{
    protected static $handle = 'heroicon';

    private function renderBladeToHtml(string $variant, string $icon, Collection $attrs): ?string
    {
        $variantPrefix = Str::substr($variant, 0, 1);

        if ($variantPrefix === '') {
            return null;
        }

        $attrsString = $attrs->map(function ($value, $key) {
            if (is_int($key)) {
                return (string) $value;
            }

            $parsedValue = gettype($value) === 'string' ? $value : var_export($value, true);
            $escapedValue = htmlspecialchars($parsedValue, ENT_COMPAT, 'UTF-8', false);

            return $key.'='.'"'.$escapedValue.'"';
        })->join(' ');

        try {
            return Blade::render('<x-heroicon-'.$variantPrefix.'-'.$icon.' '.$attrsString.' />');
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function render(?string $variant = null, ?string $icon = null): ?string
    {
        $variant = Str::lower((string) ($variant ?? $this->params->get('variant')));
        $icon = Str::kebab((string) ($icon ?? $this->params->get('icon')));

        if ($variant === '' || $icon === '') {
            return null;
        }

        $attrs = $this->params->except(['as', 'scope', 'variant', 'icon']);

        return $this->renderBladeToHtml($variant, $icon, $attrs);
    }

    /**
     * The {{ heroicon }} tag.
     */
    public function index(): ?string
    {
        return $this->render();
    }

    /**
     * The {{ heroicon:mini }} tag.
     */
    public function mini(): ?string
    {
        return $this->render('mini');
    }

    /**
     * The {{ heroicon:outline }} tag.
     */
    public function outline(): ?string
    {
        return $this->render('outline');
    }

    /**
     * The {{ heroicon:solid }} tag.
     */
    public function solid(): ?string
    {
        return $this->render('solid');
    }

    /**
     * The {{ heroicon:{variant}:{icon} }} tag.
     */
    public function wildcard(string $tag): ?string
    {
        [$variant, $icon] = array_pad(explode(':', $tag, 2), 2, null);
        $icon = $icon ?? $this->params->get('icon');

        return $this->render($variant, $icon);
    }
}

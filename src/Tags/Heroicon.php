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

    private function renderBladeToHtml(string $variant, string $icon, Collection $attrs): string
    {
        $attrsString = $attrs->map(function ($value, $key) {
            $parsedValue = gettype($value) === 'string' ? $value : var_export($value, true);

            return $key.'='.'"'.$parsedValue.'"';
        })->join(' ');

        return Blade::render('<x-heroicon-'.$variant[0].'-'.$icon.' '.$attrsString.' />');
    }

    private function render(string $variant = null, string|null $icon = null): string
    {
        $variant = $variant ?? Str::lower($this->params->get('variant'));
        $icon = $icon ?? Str::lower($this->params->get('icon'));

        $attrs = $this->params->except(['as', 'scope', 'variant', 'icon']);

        return $this->renderBladeToHtml($variant, $icon, $attrs);
    }

    /**
     * The {{ heroicon }} tag.
     */
    public function index(): string
    {
        return $this->render();
    }

    /**
     * The {{ heroicon:mini }} tag.
     */
    public function mini(): string
    {
        return $this->render('mini');
    }

    /**
     * The {{ heroicon:outline }} tag.
     */
    public function outline(): string
    {
        return $this->render('outline');
    }

    /**
     * The {{ heroicon:solid }} tag.
     */
    public function solid(): string
    {
        return $this->render('solid');
    }

    /**
     * The {{ heroicon:{variant}:{icon} }} tag.
     */
    public function wildcard(string $tag): string
    {
        [$variant, $icon] = Str::of($tag)->split('/:/')->toArray();
        $icon = Str::kebab($icon);

        return $this->render($variant, $icon);
    }
}

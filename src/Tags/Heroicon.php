<?php

namespace StefanGalescu\Heroicons\Tags;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Statamic\Tags\Tags;

class Heroicon extends Tags
{
    protected static $handle = 'heroicon';

    private function getClassPrefix(string $variant)
    {
        return 'heroicon-' . ($variant === 'outline' ? 'outline' : 'solid');
    }

    private function getClasses(string $variant)
    {
        $classPrefix = $this->getClassPrefix($variant);
        $staticClasses = Str::start($this->params->get('class', ''), $classPrefix . ' ');
        $dynamicClasses = $this->params['x-bind:class'] ?? $this->params['v-bind:class'] ?? null;

        return [
            'static' => $staticClasses,
            'dynamic' => $dynamicClasses,
        ];
    }

    private function getHtml(string $variant, $icon, Collection $attrs)
    {
        $attrsString = $attrs->map(function ($value, $key) {
            $parsedValue = gettype($value) === 'string' ? $value : var_export($value, true);
            return $key . '=' . '"' . $parsedValue . '"';
        })->join(' ');

        return '<x-heroicon-' . $variant[0] . '-' . $icon . ' ' . $attrsString .  ' />';
    }

    private function render(string $variant = null, string $icon = null, array $classes = null)
    {
        $variant = $variant ?? Str::lower($this->params->get('variant'));
        $icon = $icon ?? Str::lower($this->params->get('icon'));
        $classes = $classes ?? $this->getClasses($variant);

        $attrs = $this->params->except(['as', 'scope', 'variant', 'icon']);

        $html = $this->getHtml($variant, $icon, $attrs);
        $component = Blade::compileString($html);

        return Blade::render($component);
    }

    /**
     * The {{ heroicon }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        return $this->render();
    }

    /**
     * The {{ heroicon:outline }} tag.
     *
     * @return string|array
     */
    public function outline()
    {
        return $this->render('outline');
    }

    /**
     * The {{ heroicon:solid }} tag.
     *
     * @return string|array
     */
    public function solid()
    {
        return $this->render('solid');
    }

    /**
     * The {{ heroicon:{variant}:{icon} }} tag.
     *
     * @return string|array
     */
    public function wildcard(string $tag)
    {
        [$variant, $icon] = Str::of($tag)->split('/:/')->toArray();
        $icon = Str::kebab($icon);

        return $this->render($variant, $icon);
    }
}

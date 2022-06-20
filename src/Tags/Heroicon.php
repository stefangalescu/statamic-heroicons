<?php

namespace StefanGalescu\Heroicons\Tags;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Statamic\Tags\Tags;

class Heroicon extends Tags
{
    protected static $handle = 'heroicon';

    private function renderBladeToHtml(string $variant, $icon, Collection $attrs)
    {
        $attrsString = $attrs->map(function ($value, $key) {
            $parsedValue = gettype($value) === 'string' ? $value : var_export($value, true);
            return $key . '=' . '"' . $parsedValue . '"';
        })->join(' ');

        $blade = '<x-heroicon-' . $variant[0] . '-' . $icon . ' ' . $attrsString .  ' />';
        $component = Blade::compileString($blade);

        return Blade::render($component);
    }

    private function render(string $variant = null, string $icon = null)
    {
        $variant = $variant ?? Str::lower($this->params->get('variant'));
        $icon = $icon ?? Str::lower($this->params->get('icon'));

        $attrs = $this->params->except(['as', 'scope', 'variant', 'icon']);

        return $this->renderBladeToHtml($variant, $icon, $attrs);
    }

    /**
     * The {{ heroicon }} tag.
     *
     * @return string
     */
    public function index()
    {
        return $this->render();
    }

    /**
     * The {{ heroicon:outline }} tag.
     *
     * @return string
     */
    public function outline()
    {
        return $this->render('outline');
    }

    /**
     * The {{ heroicon:solid }} tag.
     *
     * @return string
     */
    public function solid()
    {
        return $this->render('solid');
    }

    /**
     * The {{ heroicon:{variant}:{icon} }} tag.
     *
     * @return string
     */
    public function wildcard(string $tag)
    {
        [$variant, $icon] = Str::of($tag)->split('/:/')->toArray();
        $icon = Str::kebab($icon);

        return $this->render($variant, $icon);
    }
}

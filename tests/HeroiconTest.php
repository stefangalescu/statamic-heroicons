<?php

namespace StefanGalescu\Heroicons\Tests;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertStringContainsString;
use Statamic\Statamic;

class HeroiconTest extends TestCase
{
    public function render(string $variant, string $icon, array $attrs = [])
    {
        return Statamic::tag('heroicon')->params(array_merge(['variant' => $variant, 'icon' => $icon], $attrs))->fetch();
    }

    public function getSvgAsset(string $variant, string $icon)
    {
        return svg('heroicon-'.$variant[0].'-'.$icon)->toHtml();
    }

    public function test_can_render_heroicon_using_outline_variant()
    {
        $variant = 'outline';
        $icon = 'bars-3';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_solid_variant()
    {
        $variant = 'solid';
        $icon = 'bars-3';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_mini_variant()
    {
        $variant = 'mini';
        $icon = 'bars-3';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_add_attributes_to_svg()
    {
        $render = $this->render('outline', 'bars-3', ['class' => 'w-6 h-6', 'title="Main menu"']);

        assertStringContainsString('class="w-6 h-6"', $render);
        assertStringContainsString('title="Main menu"', $render);
    }

    public function test_can_add_dynamically_binded_attributes_to_svg()
    {
        $render = $this->render('outline', 'bars-3', ['x-bind:class' => "true ? 'w-6 h-6' : 'w-5 h-5'"]);

        assertStringContainsString('x-bind:class="true ? \'w-6 h-6\' : \'w-5 h-5\'"', $render);
    }

    public function test_will_not_throw_when_icon_name_is_invalid()
    {
        $render = $this->render('outline', 'invalid-icon-name');

        assertNull($render);
    }
}

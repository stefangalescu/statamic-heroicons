<?php

namespace StefanGalescu\Heroicons\Tests;

use Statamic\Statamic;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertStringContainsString;

class HeroiconTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function render(string $variant, string $icon, array $attrs = [])
    {
        return Statamic::tag('heroicon')->params(array_merge(['variant' => $variant, 'icon' => $icon], $attrs))->fetch();
    }

    public function getSvgAsset(string $variant, string $icon)
    {
        return file_get_contents(__DIR__ . '/../vendor/blade-ui-kit/blade-heroicons/resources/svg/' . $variant[0] . '-' . $icon . '.svg');
    }

    /** @test */
    public function can_render_heroicon_using_outline_variant()
    {
        $variant = 'outline';
        $icon = 'menu';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    /** @test */
    public function can_render_heroicon_using_solid_variant()
    {
        $variant = 'solid';
        $icon = 'menu';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    /** @test */
    public function can_add_attributes_to_svg()
    {
        $render = $this->render('outline', 'menu', ['class' => 'w-6 h-6', 'title="Main menu"']);

        assertStringContainsString('class="w-6 h-6"', $render);
        assertStringContainsString('title="Main menu"', $render);
    }

    /** @test */
    public function can_add_dynamically_binded_attributes_to_svg()
    {
        $render = $this->render('outline', 'menu', ['x-bind:class' => "true ? 'w-6 h-6' : 'w-5 h-5'"]);

        assertStringContainsString('x-bind:class="true ? \'w-6 h-6\' : \'w-5 h-5\'"', $render);
    }
}

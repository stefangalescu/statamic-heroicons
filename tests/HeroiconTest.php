<?php

declare(strict_types=1);

namespace StefanGalescu\Heroicons\Tests;

use Statamic\Statamic;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertStringContainsString;

class HeroiconTest extends TestCase
{
    public function render(string $variant, string $icon, array $attrs = []): ?string
    {
        return Statamic::tag('heroicon')->params(array_merge(['variant' => $variant, 'icon' => $icon], $attrs))->fetch();
    }

    public function renderWildcard(string $tag, array $attrs = []): ?string
    {
        return Statamic::tag('heroicon:'.$tag)->params($attrs)->fetch();
    }

    public function getSvgAsset(string $variant, string $icon): string
    {
        return svg('heroicon-'.$variant[0].'-'.$icon)->toHtml();
    }

    public function test_can_render_heroicon_using_outline_variant(): void
    {
        $variant = 'outline';
        $icon = 'bars-3';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_solid_variant(): void
    {
        $variant = 'solid';
        $icon = 'bars-3';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_mini_variant(): void
    {
        $variant = 'mini';
        $icon = 'bars-3';

        $render = $this->render($variant, $icon);
        $svg = $this->getSvgAsset($variant, $icon);

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_outline_shorthand(): void
    {
        $render = $this->renderWildcard('outline', ['icon' => 'bars-3']);
        $svg = $this->getSvgAsset('outline', 'bars-3');

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_solid_shorthand(): void
    {
        $render = $this->renderWildcard('solid', ['icon' => 'bars-3']);
        $svg = $this->getSvgAsset('solid', 'bars-3');

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_mini_shorthand(): void
    {
        $render = $this->renderWildcard('mini', ['icon' => 'bars-3']);
        $svg = $this->getSvgAsset('mini', 'bars-3');

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_wildcard_syntax(): void
    {
        $render = $this->renderWildcard('outline:bars-3');
        $svg = $this->getSvgAsset('outline', 'bars-3');

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_render_heroicon_using_wildcard_syntax_with_camel_case(): void
    {
        $render = $this->renderWildcard('outline:arrowLeft');
        $svg = $this->getSvgAsset('outline', 'arrow-left');

        assertEquals(trim($render), trim($svg));
    }

    public function test_can_add_attributes_to_svg(): void
    {
        $render = $this->render('outline', 'bars-3', ['class' => 'w-6 h-6', 'title="Main menu"']);

        assertStringContainsString('class="w-6 h-6"', $render);
        assertStringContainsString('title="Main menu"', $render);
    }

    public function test_can_add_dynamically_binded_attributes_to_svg(): void
    {
        $render = $this->render('outline', 'bars-3', ['x-bind:class' => "true ? 'w-6 h-6' : 'w-5 h-5'"]);

        assertStringContainsString('x-bind:class="true ? \'w-6 h-6\' : \'w-5 h-5\'"', $render);
    }

    public function test_will_not_throw_when_icon_name_is_invalid(): void
    {
        $render = $this->render('outline', 'invalid-icon-name');

        assertNull($render);
    }

    public function test_wildcard_returns_null_for_invalid_icon(): void
    {
        $render = $this->renderWildcard('outline:invalid-icon-name');

        assertNull($render);
    }
}

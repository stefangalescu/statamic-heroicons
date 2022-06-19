<?php

namespace StefanGalescu\Heroicons\Exceptions\Solutions;

use Facade\IgnitionContracts\Solution;

class IncorrectEngineSolution implements Solution
{
    public function getSolutionTitle(): string
    {
        return 'The solution title goes here';
    }

    public function getSolutionDescription(): string
    {
        return 'This is a longer description of the solution that you want to show.';
    }

    public function getDocumentationLinks(): array
    {
        return [
            'Statamic Documentation' => 'https://statamic.dev/new-antlers-parser#about',
        ];
    }
}

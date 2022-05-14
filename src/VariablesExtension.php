<?php declare(strict_types=1);
/*
 * Copyright (c) 2020 Cristiano Cinotti
 *
 * This file is part of the Susina\TwigExtensions package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license Apache-2.0
 */

namespace Susina\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

class VariablesExtension extends AbstractExtension
{
    public function getTests(): array
    {
        return [
            new TwigTest('array', 'is_array'),
            new TwigTest('boolean', 'is_bool'),
            new TwigTest('float', 'is_float'),
            new TwigTest('double', 'is_double'),
            new TwigTest('integer', 'is_int'),
            new TwigTest('object', 'is_object'),
            new TwigTest('scalar', 'is_scalar'),
            new TwigTest('string', 'is_string'),
            new TwigTest('instanceOf', fn (?object $object, string $class): bool => $object instanceof $class),
        ];
    }

    /**
     * @return TwigFunction[]
     * @psalm-suppress MissingClosureParamType The closure param is mixed.
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_type', 'gettype'),
            new TwigFunction('var_export', fn ($variable): string => var_export($variable, true)),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'bool_to_string',
                fn (bool $value, string $true = 'true', string $false = 'false'): string => $value ? $true : $false
            )
        ];
    }
}

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

class StringExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('quote', fn (string $value, string $quot = '\''): string => "{$quot}$value{$quot}"),
        ];
    }
}

<?php declare(strict_types=1);
/*
 * Copyright (c) 2020 - 2022 Cristiano Cinotti
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
            new TwigFilter(
                'to_kb',
                fn (string|int $value, ?string $decimal = null, ?string $thousands = null): string =>
                    (int) $value % 1024 ?
                        number_format((int) $value / 1024, 2, $decimal, $thousands) :
                        number_format((int) $value / 1024)
            ),
            new TwigFilter(
                'to_mb',
                fn (string|int $value, ?string $decimal = null, ?string $thousands = null): string =>
                (int) $value % 1048576 ?
                    number_format((int) $value / 1048576, 2, $decimal, $thousands) :
                    number_format((int) $value / 1048576)
            )
        ];
    }
}

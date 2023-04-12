<?php declare(strict_types=1);
/*
 * Copyright (c) 2020 - 2023 Cristiano Cinotti
 *
 * This file is part of the Susina\TwigExtensions package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license Apache-2.0
 */

namespace Susina\TwigExtensions;

use Susina\TwigExtensions\Exception\TwigFilterException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StringExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('quote', fn (string $value, string $quot = '\''): string => "{$quot}$value{$quot}"),
            new TwigFilter(
                'to_*',
                function (string $suffix, string|int $value, ?string $decimal = null, ?string $thousands = null): string
                {
                    $divider = match ($suffix) {
                        'kb' => 1024,
                        'mb' => 1048576,
                        'gb' => 1073741824,
                        default => throw new TwigFilterException("The filter `to_$suffix` does not exist. Available filters are: `to_kb`, `to_mb`,`to_gb`.")
                    };

                    return (int) $value % $divider ?
                        number_format((int) $value / $divider, 2, $decimal, $thousands) :
                        number_format((int) $value / $divider)
                    ;            
                }    
            )
        ];
    }
}

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

namespace Susina\TwigExtensions\Tests;

use Susina\TwigExtensions\GravatarExtension;
use Susina\TwigExtensions\StringExtension;
use Susina\TwigExtensions\VariablesExtension;
use Twig\Test\IntegrationTestCase;

class IntegrationTest extends IntegrationTestCase
{
    public function getExtensions(): array
    {
        return [
            new VariablesExtension(),
            new StringExtension(),
            new GravatarExtension()
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getFixturesDir(): string
    {
        return __DIR__ . '/Fixtures';
    }
}

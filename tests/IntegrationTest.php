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

namespace Susina\TwigExtensions\Tests;

use Susina\TwigExtensions\StringExtension;
use Susina\TwigExtensions\VariablesExtension;
use Twig\Test\IntegrationTestCase;

class IntegrationTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        return [
            new VariablesExtension(),
            new StringExtension(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getFixturesDir()
    {
        return __DIR__.'/Fixtures';
    }
}

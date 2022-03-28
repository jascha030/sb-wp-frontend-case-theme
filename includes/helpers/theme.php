<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Theme;

use DI\NotFoundException;
use Jascha030\WpFrontendCaseTheme\Theme\ThemeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\service;

/**
 * Retrieve the bound ThemeInterface implementation.
 *
 * @throws ContainerExceptionInterface|NotFoundException
 * @throws NotFoundExceptionInterface
 */
function getTheme(): ThemeInterface
{
    return service(ThemeInterface::class);
}

/**
 * Retrieve the theme instance, alias of `getTheme()`.
 *
 * @throws ContainerExceptionInterface|NotFoundException
 * @throws NotFoundExceptionInterface
 *
 * @see ThemeInterface
 */
function theme(): ThemeInterface
{
    return getTheme();
}

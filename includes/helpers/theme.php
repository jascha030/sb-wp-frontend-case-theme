<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Theme;

use DI\NotFoundException;
use Exception;
use Jascha030\WpFrontendCaseTheme\Theme\ThemeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\service;

/**
 * Retrieve the bound ThemeInterface implementation.
 *
 * @noinspection PhpUnhandledExceptionInspection
 */
function getTheme(): ThemeInterface
{
    try {
        return service(ThemeInterface::class);
    } catch (Exception|NotFoundException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        if (! defined('ABSPATH')) {
            throw $e;
        }

        \error_log($e->getMessage());
        \wp_die($e->getMessage());
    }
}

/**
 * Retrieve the theme instance, alias of `getTheme()`.
 *
 * @see          ThemeInterface
 *
 * @noinspection PhpUnhandledExceptionInspection
 */
function theme(): ThemeInterface
{
    return getTheme();
}

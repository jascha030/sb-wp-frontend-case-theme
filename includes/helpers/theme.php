<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Theme;

use DI\NotFoundException;
use Exception;
use Jascha030\WpFrontendCaseTheme\Theme\Asset\Script\Script;
use Jascha030\WpFrontendCaseTheme\Theme\Asset\Style\Style;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\service;

function themeSupports(): array
{
    try {
        return service('theme.supports');
    } catch (Exception|NotFoundException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        \error_log($e->getMessage());

        return [];
    }
}

/**
 * @return Style[]
 */
function themeStyles(): array
{
    try {
        return service('theme.css');
    } catch (Exception|NotFoundException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        \error_log($e->getMessage());

        return [];
    }
}

/**
 * @return Script[]
 */
function themeScripts(): array
{
    try {
        return service('theme.css');
    } catch (Exception|NotFoundException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        \error_log($e->getMessage());

        return [];
    }
}

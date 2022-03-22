<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Theme;

use DI\NotFoundException;
use Exception;
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

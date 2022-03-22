<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Twig;

use DI\NotFoundException;
use Jascha030\Twig\TwigServiceInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\service;

/**
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 * @throws NotFoundException
 */
function asString(string $template, array $context = []): string
{
    return service(TwigServiceInterface::class)?->renderString($template, $context) ?? '';
}

/**
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 * @throws NotFoundException
 */
function render(string $template, array $context = []): void
{
    service(TwigServiceInterface::class)?->render($template, $context);
}

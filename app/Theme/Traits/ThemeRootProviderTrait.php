<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Traits;

use DI\NotFoundException;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\service;

trait ThemeRootProviderTrait
{
    public function getThemeRoot(): string
    {
        if (function_exists('get_template_directory_uri')) {
            return get_template_directory_uri();
        }

        try {
            return service('theme.root');
        } catch (Exception|NotFoundException|NotFoundExceptionInterface|ContainerExceptionInterface) {
            return dirname(__FILE__, 4);
        }
    }
}

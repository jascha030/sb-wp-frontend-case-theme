<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Traits;

use Exception;
use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\theme;

trait ThemeRootProviderTrait
{
    public function getThemeRoot(bool $preferUri = true): string
    {
        try {
            return $preferUri ? theme()->getRootUri() : theme()->getRootDir();
        } catch (Exception) {
            return dirname(__FILE__, 4);
        }
    }
}

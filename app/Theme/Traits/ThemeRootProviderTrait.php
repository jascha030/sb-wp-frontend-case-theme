<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Traits;

use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\theme;

trait ThemeRootProviderTrait
{
    public function getThemeRoot(bool $preferUri = true): string
    {
        return $preferUri
            ? theme()->getRootUri() ?? theme()->getRootDir()
            : theme()->getRootDir();
    }
}

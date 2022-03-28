<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\Script\ScriptInterface;
use Jascha030\WpFrontendCaseTheme\Theme\Asset\Style\StyleInterface;

interface ThemeInterface
{
    /**
     * @return ScriptInterface[]
     */
    public function getScripts(): array;

    /**
     * @return StyleInterface[]
     */
    public function getStyles(): array;

    /**
     * @return array
     */
    public function getSupports(): array;
}

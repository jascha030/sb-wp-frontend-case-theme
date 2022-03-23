<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset\Script;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\AssetInterface;

interface ScriptInterface extends AssetInterface, LocalizeInterface
{
    /**
     * Returning true informs WordPress to load the script inside the footer, instead of the head.
     */
    public function inFooter(): bool;
}

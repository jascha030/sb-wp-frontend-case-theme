<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset\Script;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\AssetInterface;

interface LocalizableInterface extends AssetInterface
{
    public function inFooter(): bool;
}

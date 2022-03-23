<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset\Style;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\AssetInterface;

interface StyleInterface extends AssetInterface
{
    public function getMedia(): string;
}

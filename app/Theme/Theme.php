<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

class Theme implements ThemeInterface
{
    public function __construct(
        private array $scripts,
        private array $styles,
        private array $supports,
    ) {
    }

    public function getScripts(): array
    {
        return $this->scripts;
    }

    public function getStyles(): array
    {
        return $this->styles;
    }

    public function getSupports(): array
    {
        return $this->supports;
    }
}

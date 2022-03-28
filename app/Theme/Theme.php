<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

class Theme implements ThemeInterface
{
    public function __construct(
        private string $root,
        private ?string $uri,
        private array $scripts,
        private array $styles,
        private array $supports,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getRootDir(): string
    {
        return $this->root;
    }

    /**
     * {@inheritDoc}
     */
    public function getRootUri(): ?string
    {
        return $this->uri;
    }

    /**
     * {@inheritDoc}
     */
    public function getScripts(): array
    {
        return $this->scripts ?? [];
    }

    /**
     * {@inheritDoc}
     */
    public function getStyles(): array
    {
        return $this->styles;
    }

    /**
     * {@inheritDoc}
     */
    public function getSupports(): array
    {
        return $this->supports;
    }
}

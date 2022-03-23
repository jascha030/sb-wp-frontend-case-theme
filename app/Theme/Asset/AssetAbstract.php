<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset;

abstract class AssetAbstract implements AssetInterface
{
    public function __construct(
        private string $handle,
        private string $file,
        private ?array $dependencies = null,
        private string|false|null $version = null,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     * {@inheritDoc}
     */
    public function getFile(): string
    {
        return sprintf('%s/%s', $this->getThemeRoot(), $this->file);
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies(): ?array
    {
        return $this->dependencies;
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion(): string|bool|null
    {
        return $this->version;
    }

    abstract public function getThemeRoot(): string;

    /**
     * Create instance, provide the handle and either: the filename relative to the theme root as string,
     * or all the constructor arguments in the constructor order.
     */
    public static function create(string $handle, string|array $arguments): static
    {
        if (is_string($arguments)) {
            return new static($handle, $arguments);
        }

        return new static($handle, ...$arguments);
    }
}

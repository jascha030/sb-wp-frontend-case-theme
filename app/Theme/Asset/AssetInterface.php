<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset;

/**
 * Interface representing a WordPress asset.
 */
interface AssetInterface
{
    /**
     * Handle for WordPress to identify a script or style asset by.
     */
    public function getHandle(): string;

    /**
     * File name relative to the theme root.
     */
    public function getFile(): string;

    /**
     * Array of WordPress asset dependencies (optional).
     */
    public function getDependencies(): ?array;

    /**
     * A version number, used by WordPress to check the asset's caching eligibility.
     */
    public function getVersion(): string|bool|null;
}

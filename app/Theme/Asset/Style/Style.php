<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset\Style;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\AssetAbstract;
use Jascha030\WpFrontendCaseTheme\Theme\Traits\ThemeRootProviderTrait;

class Style extends AssetAbstract implements StyleInterface
{
    use ThemeRootProviderTrait;

    private string $media;

    public function __construct(
        string $handle,
        string $file,
        ?array $dependencies = null,
        false|string|null $version = null,
        string $media = 'all',
    ) {
        $this->media = $media;

        parent::__construct($handle, $file, $dependencies, $version);
    }

    public function getMedia(): string
    {
        return $this->media;
    }
}

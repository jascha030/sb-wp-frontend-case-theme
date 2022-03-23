<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset\Script;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\AssetAbstract;
use Jascha030\WpFrontendCaseTheme\Theme\Traits\ThemeRootProviderTrait;

class Script extends AssetAbstract implements ScriptInterface
{
    use ThemeRootProviderTrait;

    private bool $inFooter;

    private bool $localize;

    private ?string $localizationObjectName;

    private ?array  $localizationData;

    public function __construct(
        string $handle,
        string $file,
        ?array $dependencies = null,
        false|string|null $version = null,
        bool $inFooter = false,
        bool $localize = false,
        ?string $localizeObjectName = null,
        ?array $localizationData = null,
    ) {
        $this->inFooter               = $inFooter;
        $this->localize               = $localize;
        $this->localizationObjectName = $localizeObjectName;
        $this->localizationData       = $localizationData;

        parent::__construct($handle, $file, $dependencies, $version);
    }

    public function localize(): bool
    {
        return $this->localize;
    }

    public function getObjectName(): ?string
    {
        return $this->localize()
            ? $this->localizationObjectName ?? $this->getHandle()
            : null;
    }

    public function getData(): ?array
    {
        return $this->localize()
            ? $this->localizationData ?? []
            : null;
    }

    /**
     * {@inheritDoc}
     */
    public function inFooter(): bool
    {
        return $this->inFooter;
    }
}

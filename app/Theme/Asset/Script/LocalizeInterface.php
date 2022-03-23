<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme\Asset\Script;

interface LocalizeInterface
{
    public function localize(): bool;

    public function getObjectName(): ?string;

    public function getData(): ?array;
}

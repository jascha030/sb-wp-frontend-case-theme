<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Exception\Config;

/**
 * Simple interface for exceptions caused by invalid theme configurations.
 */
interface ConfigExceptionInterface
{
    /**
     * Provide the cause config key.
     */
    public function getKey(): string;

    /**
     * Provide the causing value (optional).
     */
    public function getValue(): mixed;

    /**
     * Provide an array of valid types (optional).
     */
    public function getRequiredTypes(): ?array;
}

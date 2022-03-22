<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Exception\Config;

use InvalidArgumentException;

class InvalidThemeConfigException extends InvalidArgumentException implements ConfigExceptionInterface
{
    public function __construct(
        private string $key,
        private mixed $value = null,
        private ?array $requiredTypes = null
    ) {
        parent::__construct($this->createMessage());
    }

    /**
     * {@inheritDoc}
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequiredTypes(): ?array
    {
        return $this->requiredTypes;
    }

    private function createMessage(): string
    {
        $valueMsg = null !== $this->getValue()
            ? ": \"{$this->getValue()}\""
            : '';
        $typesMsg = null !== $this->getRequiredTypes()
            ? '. Accepted type(s): ' . implode(', ', $this->getRequiredTypes()) :
            '';

        return sprintf(
            'Invalid value%s for theme config key: "%s"%s.',
            $valueMsg,
            $this->getKey(),
            $typesMsg
        );
    }
}

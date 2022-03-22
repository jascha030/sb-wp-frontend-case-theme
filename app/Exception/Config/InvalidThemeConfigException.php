<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Exception\Config;

use InvalidArgumentException;

class InvalidThemeConfigValueException extends InvalidArgumentException implements ConfigExceptionInterface
{
    public function __construct(
        private string $key,
        private mixed $value = null,
        private ?array $requiredTypes = null
    ) {
        parent::__construct($this->createMessage());
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getRequiredTypes(): array
    {
        return $this->requiredTypes;
    }

    private function createMessage(): string
    {
        $valueMsg = null !== $this->getValue()
            ? ": \"{$this->getValue()}\""
            : '';
        $typesMsg = null !== $this->getRequiredTypes()
            ? '. Accepted type(s): ' . implode($this->getRequiredTypes()) :
            '';

        return sprintf(
            'Invalid value%s for theme config key: "%s"%s.',
            $valueMsg,
            $this->getKey(),
            $typesMsg
        );
    }
}

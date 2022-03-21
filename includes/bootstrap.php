<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Bootstrap;

use InvalidArgumentException;
use RuntimeException;

if (! defined('SB_FEC_THEME_CONFIG_FILE')) {
    define('SB_FEC_THEME_CONFIG_FILE', __DIR__ . '/config.php');
}

function config(): \ArrayIterator
{
    static $config;

    if (isset($config)) {
        return $config;
    }

    if (! defined('SB_FEC_THEME_CONFIG_FILE')) {
        throw new RuntimeException('SB_FEC_THEME_CONFIG_FILE was not defined.');
    }

    if (! file_exists(SB_FEC_THEME_CONFIG_FILE)) {
        throw new InvalidArgumentException(sprintf(
            'Could not find a valid config file at path: "%s".',
            SB_FEC_THEME_CONFIG_FILE
        ));
    }

    return $config = new \ArrayIterator(SB_FEC_THEME_CONFIG_FILE);
}

/**
 * @return array|mixed
 * @throws InvalidArgumentException|RuntimeException
 */
function getThemeConfig(?string $key = null): mixed
{
    if (! isset($key)) {
        return config()->getArrayCopy();
    }

    if (! config()->offsetExists($key)) {
        throw new InvalidArgumentException(
            "Could not find theme configuration with key: \"{$key}\"."
        );
    }

    return config()->offsetGet($key);
}

function getAutoloader(string $themeRoot): string
{
}

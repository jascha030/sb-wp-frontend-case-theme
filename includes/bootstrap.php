<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

use InvalidArgumentException;
use RuntimeException;

/**
 * Default theme config.php path.
 * Set prior to theme init to override, preferably in `wp-config.php`.
 */
if (! defined('SB_FEC_THEME_CONFIG_FILE')) {
    define('SB_FEC_THEME_CONFIG_FILE', __DIR__ . '/config.php');
}

/**
 * Retrieve the main config file as iterator.
 *
 * Allows for alternative config file by setting SB_FEC_THEME_CONFIG_FILE in wp-config.php.
 * Use absolute paths when setting SB_FEC_THEME_CONFIG_FILE.
 */
function config(): \ArrayIterator
{
    static $config;

    if (isset($config)) {
        return $config;
    }

    if (! defined('SB_FEC_THEME_CONFIG_FILE')) {
        // todo: add config file exception.
        throw new RuntimeException('SB_FEC_THEME_CONFIG_FILE was not defined.');
    }

    if (! file_exists(SB_FEC_THEME_CONFIG_FILE)) {
        // todo: add composer exception.
        throw new InvalidArgumentException(sprintf(
            'Could not find a valid config file at path: "%s".',
            SB_FEC_THEME_CONFIG_FILE
        ));
    }

    return $config = new \ArrayIterator(include SB_FEC_THEME_CONFIG_FILE);
}

/**
 * Get value for either, a specific config key or an array copy of the complete config.
 *
 * @throws InvalidArgumentException|RuntimeException
 *
 * @return array|mixed
 */
function getThemeConfig(?string $key = null): mixed
{
    if (! isset($key)) {
        return config()->getArrayCopy();
    }

    if (! config()->offsetExists($key)) {
        // todo: add config exception.
        throw new InvalidArgumentException(
            "Could not find theme configuration with key: \"{$key}\"."
        );
    }

    return config()->offsetGet($key);
}

/**
 * Array map callback used in the `load()` function.
 *
 * @see load()
 * @see \array_map()
 */
function sanitizeAutoloadPath(string $path): string
{
    if (str_ends_with('autoload.php', $path)) {
        return $path;
    }

    if (str_ends_with('vendor', $path)) {
        return $path . '/' . 'autoload.php';
    }

    if (str_ends_with('/', $path)) {
        return str_ends_with('vendor/', $path)
            ? $path . 'autoload.php'
            : $path . 'vendor/autoload.php';
    }

    return $path . '/vendor/autoload.php';
}

/**
 * Resolves and requires the configured autoloaders.
 *
 * @throws RuntimeException
 */
function load(string $themeRoot): void
{
    $resolver = getThemeConfig('autoload_paths');

    if (is_callable($resolver)) {
        $paths = $resolver($themeRoot);
    }

    if (is_array($resolver)) {
        $paths = $resolver;
    }

    if (! is_callable($resolver) && ! is_array($resolver)) {
        // todo: config exception.
        throw new RuntimeException('No valid config set for key: "autoload_paths".');
    }

    /**
     * @noinspection PhpUndefinedVariableInspection
     */
    $paths = array_filter(
        array_map('Jascha030\WpFrontendCaseTheme\Theme\sanitizeAutoloadPath', $paths),
        static fn (string $path): bool => file_exists($path)
    );

    if (0 === count($paths)) {
        // todo: add composer exception.
        throw new RuntimeException('No autoloaders could be retrieved.');
    }

    foreach ($paths as $path) {
        require_once $path;
    }
}

/**
 * Prepends current namespace for callables provided as string literal.
 *
 * @see __NAMESPACE__
 */
function namespaced(string|callable $callable): string|callable
{
    if (! is_string($callable)) {
        return $callable;
    }

    return sprintf('%s\\%s', __NAMESPACE__, $callable);
}

/**
 * Copy of WordPress's `add_action()` function with additions.
 *
 * When callables are provided as string literal, they are prepended with the current namespace.
 * Adds (partial) compatibility for phpunit by just returning `true`, outside of WordPress context.
 *
 * @see __NAMESPACE__
 * @see \add_action()
 */
function add_action(string $tag, string|callable $callable, int $prio = 10, int $args = 0): bool
{
    if (! function_exists('\\add_action')) {
        return true;
    }

    return \add_action($tag, namespaced($callable), $prio, $args);
}

/**
 * Copy of WordPress's `add_filter()` function with additions.
 *
 * When callables are provided as string literal, they are prepended with the current namespace.
 * Adds (partial) compatibility for phpunit by just returning `true`, outside of WordPress context.
 *
 * @see __NAMESPACE__
 * @see \add_filter()
 */
function add_filter(string $tag, string|callable $callable, int $prio = 10, int $args = 0): bool
{
    if (! function_exists('\\add_filter')) {
        return true;
    }

    return \add_filter($tag, namespaced($callable), $prio, $args);
}

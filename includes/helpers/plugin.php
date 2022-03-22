<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Plugin;

/**
 * Do function_exists calls for multiple functions at once.
 */
function functionsExist(array|string $functions): bool
{
    if (is_string($functions)) {
        return function_exists($functions);
    }

    foreach ($functions as $function) {
        if (! function_exists($function)) {
            return false;
        }
    }

    return true;
}

function getActivePlugins(): array
{
    static $activePlugins;

    if (! isset($activePlugins)) {
        if (! function_exists('get_option')) {
            return [];
        }

        $activePlugins = (array) get_option('active_plugins', []);

        if (functionsExist(['is_multisite', 'get_site_option']) && is_multisite()) {
            $activePlugins = array_merge($activePlugins, get_site_option('active_sitewide_plugins', []));
        }
    }

    return $activePlugins;
}

function pluginIsActive(string $pluginFile): bool
{
    $active = getActivePlugins();

    return isset($active[$pluginFile]) || in_array($pluginFile, $active, true);
}

function pluginInstalled(string $pluginFile): bool
{
    if (! function_exists('get_plugins')) {
        if (! defined('ABSPATH')) {
            return false;
        }

        $pluginPath = ABSPATH . 'wp-admin/includes/plugin.php';

        if (! file_exists($pluginPath)) {
            return false;
        }

        require_once $pluginPath;
    }

    $installed = \get_plugins();

    return isset($installed[$pluginFile]) || in_array($pluginFile, $installed, true);
}

/**
 * @noinspection HtmlUnknownTarget
 */
function getPluginAdminUrl(string $text): string
{
    return function_exists('get_admin_url')
        ? sprintf('<a href="%s/plugins.php?plugin_status=all&paged=1&s">%s</a>', get_admin_url(), $text)
        : $text;
}

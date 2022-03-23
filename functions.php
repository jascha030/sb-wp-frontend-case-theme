<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\Script\Script;
use RuntimeException;
use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\themeStyles;
use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\themeSupports;

/**
 * Require theme/bootstrapping functions.
 */
require_once __DIR__ . '/includes/bootstrap.php';

/**
 * Require the available composer autoload.php file(s).
 *
 * @throws RuntimeException
 */
load(__DIR__);

/**
 * Abort after autoloaders if outside of WordPress context.
 */
if (! defined('ABSPATH')) {
    return;
}

function addThemeSupports(): void
{
    foreach (themeSupports() as $feature => $value) {
        if (false === $value) {
            continue;
        }

        if (true === $value) {
            \add_theme_support($feature);

            continue;
        }

        \add_theme_support($feature, $value);
    }
}

function addThemeCss(): void
{
    foreach (themeStyles() as $value) {
        if (! is_subclass_of($value, Script::class)) {
            continue;
        }

        wp_enqueue_style(
            $value->getHandle(),
            $value->getFile(),
            $value->getDependencies(),
            $value->getVersion(),
            $value->getMedia(),
        );
    }
}

/**
 * Initialize theme.
 */
function init(): void
{
    addThemeSupports();
}

add_action('after_setup_theme', 'init', 10);

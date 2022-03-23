<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

use Jascha030\WpFrontendCaseTheme\Theme\Asset\Style\Style;
use RuntimeException;
use function add_theme_support;
use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\themeStyles;
use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\themeSupports;
use function wp_enqueue_style;

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
            add_theme_support($feature);

            continue;
        }

        add_theme_support($feature, $value);
    }
}

function enqueueStyles(): void
{
    if (empty(themeStyles())) {
        return;
    }

    foreach (themeStyles() as $value) {
        if (! is_subclass_of($value, Style::class) && ! $value instanceof Style) {
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

    add_action('wp_enqueue_scripts', 'enqueueStyles');
}

add_action('after_setup_theme', 'init', 10);

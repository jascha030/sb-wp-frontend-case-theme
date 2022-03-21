<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Theme;

use RuntimeException;

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

if (! defined('ABSPATH')) {
    return;
}

/**
 * Initialize theme.
 *
 * @return void
 */
function init(): void
{
    // Todo: theme initialization.
}

add_action('after_setup_theme', 'init', 10);

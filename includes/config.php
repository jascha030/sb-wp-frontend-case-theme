<?php

declare(strict_types=1);

return [
    'autoloader_paths' => static function (string $themeRoot): array {
        $paths = [$themeRoot];

        if (defined('ABSPATH')) {
            $paths = [ABSPATH, dirname(ABSPATH, 2), ...$paths];
        }

        if (! function_exists('apply_filters')) {
            return $paths;
        }

        return apply_filters('sb_fec_theme_autoload_paths', $paths);
    },
];

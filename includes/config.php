<?php

declare(strict_types=1);

return [
    'environment' => defined('WP_ENV') ? WP_ENV : 'develop',
    'styles'      => [
        'dist-tailwind' => 'dist/tailwind.css',
    ],
    'scripts' => [
    ],
    'autoload_paths' => static fn (string $themeRoot): array => defined('ABSPATH')
        ? [$themeRoot]
        : [
            ABSPATH,
            $themeRoot,
            dirname(ABSPATH, 2),
        ],
    'definition_dirs' => [
        __DIR__ . '/definitions',
    ],
];

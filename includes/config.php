<?php

declare(strict_types=1);

return [
    'environment' => defined('WP_ENV') ? WP_ENV : 'develop',
    'styles'      => [
        'dist-tailwind' => 'dist/tailwind.css',
    ],
    'scripts' => [
    ],
    'supports' => [
        'custom-background'                   => false,
        'customize-selective-refresh-widgets' => false,
        'custom-header-uploads'               => true,
        'custom-header'                       => true,
        'title-tag'                           => true,
        'post-thumbnails'                     => true,
        'post-formats'                        => [],
        'html5'                               => true,
        'custom-logo'                         => [
            'height'               => 300,
            'width'                => 71,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => ['site-title', 'site-description'],
            'unlink-homepage-logo' => true,
        ],
    ],
    'autoload_paths' => static fn (string $themeRoot): array => defined('ABSPATH')
        ? [
            ABSPATH,
            $themeRoot,
            dirname(ABSPATH, 2),
        ]
        : [$themeRoot],
    'definition_dirs' => [
        __DIR__ . '/definitions',
    ],
];

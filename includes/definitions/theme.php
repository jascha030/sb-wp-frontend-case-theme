<?php

declare(strict_types=1);

use function Jascha030\WpFrontendCaseTheme\Theme\getThemeConfig;

return [
    'theme.supports' => [
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
    'theme.css' => static function (): array {
        $scripts = getThemeConfig('styles');

        foreach ($scripts as $script);
    },
];

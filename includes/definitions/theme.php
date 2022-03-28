<?php

declare(strict_types=1);

use Jascha030\WpFrontendCaseTheme\Theme\Asset\Script\Script;
use Jascha030\WpFrontendCaseTheme\Theme\Asset\Style\Style;
use Jascha030\WpFrontendCaseTheme\Theme\Theme;
use Jascha030\WpFrontendCaseTheme\Theme\ThemeInterface;
use function DI\create;
use function DI\get;
use function Jascha030\WpFrontendCaseTheme\Theme\getThemeConfig;

return [
    'theme.root'     => dirname(__FILE__, 3),
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
        $styles = [];

        foreach (getThemeConfig('styles') as $handle => $arguments) {
            $styles[$handle] = new Style($handle, $arguments);
        }

        return $styles;
    },
    'theme.scripts' => static function (): array {
        $scripts = [];

        foreach (getThemeConfig('scripts') as $handle => $arguments) {
            $scripts[$handle] = new Script($handle, $arguments);
        }

        return $scripts;
    },
    ThemeInterface::class => create(Theme::class)->constructor(
        get('theme.scripts'),
        get('theme.styles'),
        get('theme.supports')
    ),
];

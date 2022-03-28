<?php

declare(strict_types=1);

use Jascha030\WpFrontendCaseTheme\Theme\Asset\Script\Script;
use Jascha030\WpFrontendCaseTheme\Theme\Asset\Style\Style;
use Jascha030\WpFrontendCaseTheme\Theme\Theme;
use Jascha030\WpFrontendCaseTheme\Theme\ThemeInterface;
use Psr\Container\ContainerInterface;
use function DI\create;
use function DI\get;
use function Jascha030\WpFrontendCaseTheme\Theme\getThemeConfig;

return [
    'theme.root' => dirname(__FILE__, 3),
    'theme.uri'  => static fn (ContainerInterface $container): ?string  => function_exists('get_template_directory_uri')
        ? get_template_directory_uri()
        : null,
    'theme.supports' => static fn (): array => getThemeConfig('supports'),
    'theme.styles'   => static function (): array {
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
        get('theme.root'),
        get('theme.uri'),
        get('theme.scripts'),
        get('theme.styles'),
        get('theme.supports'),
    ),
];

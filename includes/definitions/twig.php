<?php

declare(strict_types=1);

use Jascha030\Twig\TwigService;
use Jascha030\Twig\TwigServiceInterface;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;
use function DI\create;
use function DI\get;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\extendableData;

function getTemplateGlobals(): array
{
    global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

    return compact('posts', 'post', 'wp_did_header', 'wp_query', 'wp_rewrite', 'wpdb', 'wp_version', 'wp', 'id', 'comment', 'user_ID');
}

return [
    'twig.paths'     => [dirname(__FILE__, 3) . '/templates/twig'],
    'twig.functions' => static function (): array {
        /**
         * do_action, also can be called as action.
         *
         * @param string $tag
         * @param mixed  ...$arguments
         *
         * @see do_action()
         */
        $do_action = $action = static function (string $tag, ...$arguments): void {
            do_action($tag, ...$arguments);
        };

        /**
         * apply_filters, also can be called as filter.
         *
         * @param string $tag
         * @param        ...$arguments
         *
         * @return mixed
         *
         * @see apply_filters()
         */
        $apply_filters = $filter = static function (string $tag, ...$arguments) {
            return apply_filters($tag, ...$arguments);
        };

        /**
         * @see parse_blocks()
         */
        $parse_blocks = static fn (string $content): array => parse_blocks($content);

        /**
         * @param array $content
         *
         * @return null|string
         *
         * @see render_block()
         */
        $render_block = static fn (array $content): ?string => render_block($content);

        /**
         * @param null|string $name
         * @param array       $args
         *
         * @return false|void
         *
         * @see get_header()
         */
        $get_header = static fn (?string $name = null, array $args = []) => \get_header($name, $args);

        /**
         * @param null|string $name
         * @param array       $args
         *
         * @return mixed
         *
         * @see get_footer()
         */
        $get_footer = static fn (?string $name = null, array $args = []) => get_footer($name, $args);

        /**
         * @return bool
         *
         * @see have_posts()
         */
        $have_posts = static fn () => \have_posts();

        /**
         * @see the_post()
         */
        $the_post = static fn () => \the_post();

        return compact(
            'do_action',
            'apply_filters',
            'parse_blocks',
            'render_block',
            'get_header',
            'get_footer',
            'have_posts',
            'the_post',
            'action',
            'filter',
        );
    },
    'twig.filters' => static fn (ContainerInterface $container): array => extendableData($container, 'twig', 'filters'),
    'twig.globals' => static function (): array {
        return array_merge(getTemplateGlobals(), [
            'twig_info' => [
                'twig_repo_url' => 'https://github.com/twigphp/Twig',
                'twig_docs_url' => 'https://twig.symfony.com/doc/3.x/',
            ],
        ]);
    },
    LoaderInterface::class => create(FilesystemLoader::class)->constructor(get('twig.paths')),
    Environment::class     => static function (ContainerInterface $container): Environment {
        $environment = new Environment($container->get(LoaderInterface::class));

        if ($container->has('twig.functions')) {
            foreach ($container->get('twig.functions') as $key => $closure) {
                $environment->addFunction(new TwigFunction($key, $closure));
            }
        }

        if ($container->has('twig.filters')) {
            foreach ($container->get('twig.filters') as $key => $closure) {
                $environment->addFilter(new TwigFilter($key, $closure));
            }
        }

        if ($container->has('twig.globals')) {
            foreach ($container->get('twig.globals') as $key => $initialValue) {
                $environment->addGlobal($key, $initialValue);
            }
        }

        return $environment;
    },
    TwigServiceInterface::class => create(TwigService::class)->constructor(get(Environment::class)),
];

<?php

declare(strict_types=1);

use Jascha030\Twig\TwigService;
use Jascha030\Twig\TwigServiceInterface;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\LoaderInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;
use function DI\create;
use function DI\get;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\extendableData;

return [
    'twig.functions'   => static fn (ContainerInterface $container): array   => extendableData($container, 'twig', 'functions'),
    'twig.filters'     => static fn (ContainerInterface $container): array     => extendableData($container, 'twig', 'filters'),
    'twig.globals'     => static fn (ContainerInterface $container): array     => extendableData($container, 'twig', 'globals'),
    Environment::class => static function (ContainerInterface $container): Environment {
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

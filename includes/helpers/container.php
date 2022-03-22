<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Helpers\Container;

use DI\ContainerBuilder;
use DI\NotFoundException;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Theme\getThemeConfig;

/**
 * Retrieve composed definitions extendable from dependant projects.
 *
 * Uses 'twig.extension.keys' definition to check for pattern `twig.{$extension_key}.{$key}` in registered definitions.
 * If the pattern is matched and the definition returns an array it will be merged into the eventually returned array.
 *
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 */
function extendableData(ContainerInterface $container, string $namespace, string $key): array
{
    foreach (retrieveExtendableData($container, $namespace, $key) as $extensions) {
        $composed_data = array_combine(
            [...array_keys($composed_data ?? []), ...array_keys($extensions)],
            [...array_values($composed_data ?? []), ...array_values($extensions)]
        );
    }

    return $composed_data ?? [];
}

/**
 * Generator used by various definitions to make them extendable from dependant projects.
 *
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 */
function retrieveExtendableData(ContainerInterface $container, string $namespace, string $key): iterable
{
    foreach ($container->get('extension.keys') as $extension) {
        if ($container->has("{$namespace}.{$extension}.{$key}")) {
            $data = $container->get("{$namespace}.{$extension}.{$key}");

            if (is_array($data)) {
                yield $data;
            }
        }
    }
}

function getDefinitions(string ...$paths): \Generator
{
    foreach ($paths as $dir) {
        $files = array_diff(scandir($dir), ['..', '.']);

        foreach ($files as $file) {
            if (! str_ends_with($file, '.php')) {
                continue;
            }

            yield str_replace('.php', '', $file) => "{$dir}/{$file}";
        }
    }
}

/**
 * @throws Exception
 */
function buildContainer(?string ...$paths): ContainerInterface
{
    if (empty($paths)) {
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $paths = [dirname(__DIR__) . '/definitions'];
    }

    $builder = (new ContainerBuilder())
        ->useAutowiring(false)
        ->useAnnotations(false);

    foreach (getDefinitions(...$paths) as $definition) {
        $builder->addDefinitions($definition);
    }

    if ('production' === getThemeConfig('environment')) {
        $builder->writeProxiesToFile(true, dirname(__FILE__, 3) . '/.cache');
    }

    return $builder->build();
}

/**
 * @throws Exception
 */
function getContainer(): ContainerInterface
{
    static $container;

    if (! isset($container)) {
        $container = buildContainer(...getThemeConfig('definition_dirs'));
    }

    return $container;
}

/**
 * Retrieve an entry from the main container.
 *
 * @throws ContainerExceptionInterface|NotFoundExceptionInterface
 * @throws NotFoundException
 * @throws Exception
 */
function service(string $id): mixed
{
    if (! getContainer()->has($id)) {
        throw new NotFoundException("Could not find entry: \"{$id}\".");
    }

    return getContainer()->get($id);
}

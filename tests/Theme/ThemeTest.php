<?php

namespace Jascha030\WpFrontendCaseTheme\Tests\Theme;

use DI\NotFoundException;
use Jascha030\WpFrontendCaseTheme\Theme\Theme;
use Jascha030\WpFrontendCaseTheme\Theme\ThemeInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Jascha030\WpFrontendCaseTheme\Helpers\Container\service;
use function Jascha030\WpFrontendCaseTheme\Helpers\Theme\theme;

/**
 * @internal
 * @covers \Jascha030\WpFrontendCaseTheme\Theme\Theme
 */
class ThemeTest extends TestCase
{
    public static ?string $root = null;

    public static ?Theme $theme = null;

    public static function setUpBeforeClass(): void
    {
        self::$root  = dirname(__FILE__, 3);
        self::$theme = theme();
    }

    public static function tearDownAfterClass(): void
    {
        self::$root  = null;
        self::$theme = null;
    }

    /**
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(
            ThemeInterface::class,
            new Theme(
                service('theme.root'),
                service('theme.uri'),
                service('theme.scripts'),
                service('theme.styles'),
                service('theme.supports'),
            )
        );
    }

    public function testGetRootDir(): void
    {
        $this->assertEquals(self::$theme->getRootDir(), self::$root);
    }

    public function testGetRootUri(): void
    {
        $this->assertNull(self::$theme->getRootUri());
    }

    public function testGetScripts(): void
    {
        $this->assertIsArray(self::$theme->getScripts());
    }

    public function testGetStyles(): void
    {
        $this->assertIsArray(self::$theme->getStyles());
    }

    public function testGetSupports(): void
    {
        $this->assertIsArray(self::$theme->getSupports());
    }
}

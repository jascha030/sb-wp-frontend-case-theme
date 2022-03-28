<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Tests\Theme\Traits;

use Exception;
use Jascha030\WpFrontendCaseTheme\Theme\ThemeInterface;
use Jascha030\WpFrontendCaseTheme\Theme\Traits\ThemeRootProviderTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @covers \Jascha030\WpFrontendCaseTheme\Theme\Traits\ThemeRootProviderTrait
 */
final class ThemeRootProviderTraitTest extends TestCase
{
    public static null|MockObject|ThemeRootProviderTraitTest $traitMock = null;

    public static ?ThemeInterface $theme = null;

    public static ?string $expectedRoot = null;

    /**
     * @throws Exception
     */
    public static function setUpBeforeClass(): void
    {
        self::$traitMock    = (new self())->getMockForTrait(ThemeRootProviderTrait::class);
        self::$expectedRoot = dirname(__FILE__, 4);
    }

    public static function tearDownAfterClass(): void
    {
        self::$traitMock    = null;
        self::$expectedRoot = null;
    }

    public function testGetThemeRoot(): void
    {
        $this->assertEquals(
            self::$expectedRoot,
            self::$traitMock->getThemeRoot(false),
        );
    }

    /**
     * Tests the fallback that is called when `get_template_directory_uri()` is unavailable.
     *
     * @depends testGetThemeRoot
     */
    public function testGetThemeRootPreferUriFallbackIsRoot(): void
    {
        $this->assertEquals(
            self::$expectedRoot,
            self::$traitMock->getThemeRoot(true)
        );
    }
}

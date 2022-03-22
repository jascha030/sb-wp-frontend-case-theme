<?php

namespace Jascha030\WpFrontendCaseTheme\Tests\Jascha030\WpFrontendCaseTheme\Tests\Exception\Config;

use Jascha030\WpFrontendCaseTheme\Exception\Config\InvalidThemeConfigException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @covers \Jascha030\WpFrontendCaseTheme\Exception\Config\InvalidThemeConfigException
 */
class InvalidThemeConfigExceptionTest extends TestCase
{
    public function testGetKey(): void
    {
        $this->assertEquals(
            'test_key',
            (new InvalidThemeConfigException('test_key'))->getKey()
        );
    }

    public function testGetRequiredTypes(): void
    {
        $expected = ['string', 'string[]'];

        $this->assertEquals(
            'test_key',
            (new InvalidThemeConfigException('test_key'))->getKey()
        );
    }

    public function testGetValue(): void
    {
    }
}

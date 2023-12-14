<?php

declare(strict_types=1);

namespace MiBo\Languages\Tests;

use Generator;
use MiBo\Languages\Exceptions\LangDoesNotHaveAlpha2Exception;
use MiBo\Languages\Exceptions\LangDoesNotHaveBibliographicCodeException;
use MiBo\Languages\Exceptions\LanguageNotFoundException;
use MiBo\Languages\ISO\LanguageProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class LanguageTest
 *
 * @package MiBo\Languages\Tests
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 *
 * @coversDefaultClass \MiBo\Languages\ISO\Language
 */
final class LanguageTest extends TestCase
{
    /**
     * @small
     *
     * @covers ::__construct
     * @covers ::getAlpha2
     * @covers ::getAlpha3
     * @covers ::getAlpha3B
     * @covers ::getAlpha3T
     * @covers ::getName
     * @covers ::hasAlpha2
     * @covers ::hasAlpha3B
     * @covers ::is
     * @covers ::__toString
     * @covers \MiBo\Languages\ISO\LanguageProvider::__construct
     * @covers \MiBo\Languages\ISO\LanguageProvider::getByAlpha2
     * @covers \MiBo\Languages\ISO\LanguageProvider::getByAlpha3
     * @covers \MiBo\Languages\ISO\LanguageProvider::loadBy
     * @covers \MiBo\Languages\ISO\LanguageProvider::saveLanguage
     * @covers \MiBo\Languages\Exceptions\LangDoesNotHaveAlpha2Exception::__construct
     *
     * @param string|null $alpha2
     * @param string $alpha3
     *
     * @return void
     *
     * @dataProvider getLangWithAlpha2
     * @dataProvider getLangWithoutAlpha2
     */
    public function testAlpha2(?string $alpha2, string $alpha3): void
    {
        $provider = new LanguageProvider();
        $lang     = $provider->getByAlpha3($alpha3);

        if ($alpha2 === null) {
            $this->expectException(LangDoesNotHaveAlpha2Exception::class);
        }

        $this->assertSame($alpha2 !== null, $lang->hasAlpha2());
        $this->assertSame($alpha2, $lang->getAlpha2());
        $this->assertSame($alpha3, (string) $lang);

        $lang2 = $provider->getByAlpha2($alpha2);

        $this->assertTrue($lang2->is($lang));
        $this->assertSame($lang->getName(), $lang2->getName());
    }

    /**
     * @small
     *
     * @covers ::__construct
     *
     * @covers ::__construct
     * @covers ::getAlpha2
     * @covers ::getAlpha3
     * @covers ::getAlpha3B
     * @covers ::getAlpha3T
     * @covers ::getName
     * @covers ::hasAlpha2
     * @covers ::hasAlpha3B
     * @covers ::is
     * @covers ::__toString
     * @covers \MiBo\Languages\ISO\LanguageProvider::__construct
     * @covers \MiBo\Languages\ISO\LanguageProvider::getByAlpha3B
     * @covers \MiBo\Languages\ISO\LanguageProvider::getByAlpha3
     * @covers \MiBo\Languages\ISO\LanguageProvider::loadBy
     * @covers \MiBo\Languages\ISO\LanguageProvider::saveLanguage
     * @covers \MiBo\Languages\Exceptions\LangDoesNotHaveBibliographicCodeException::__construct
     *
     * @return void
     *
     * @dataProvider getLangWithAlpha3B
     * @dataProvider getLangWithoutAlpha3B
     */
    public function testAlpha3B(?string $alpha3B, string $alpha3): void
    {
        $provider = new LanguageProvider();
        $lang     = $provider->getByAlpha3($alpha3);

        if ($alpha3B === null) {
            $this->expectException(LangDoesNotHaveBibliographicCodeException::class);
        }

        $this->assertSame($alpha3B !== null, $lang->hasAlpha3B());
        $this->assertSame($alpha3B, $lang->getAlpha3B());
        $this->assertSame($alpha3, (string) $lang);

        $lang2 = $provider->getByAlpha3B($alpha3B);

        $this->assertTrue($lang2->is($lang));
        $this->assertSame($lang->getName(), $lang2->getName());
    }

    /**
     * @small
     *
     * @covers \MiBo\Languages\ISO\LanguageProvider::__construct
     * @covers \MiBo\Languages\ISO\LanguageProvider::getByAlpha2
     * @covers \MiBo\Languages\ISO\LanguageProvider::loadBy
     *
     * @return void
     */
    public function testInvalid(): void
    {
        $this->expectException(LanguageNotFoundException::class);

        (new LanguageProvider())->getByAlpha2('');
    }

    public static function getLangWithAlpha2(): Generator
    {
        foreach (self::getList() as $lang) {
            if ($lang['alpha2'] === null) {
                continue;
            }

            yield [
                $lang['alpha2'],
                $lang['alpha3'],
            ];
        }
    }

    public static function getLangWithoutAlpha2(): Generator
    {
        foreach (self::getList() as $lang) {
            if ($lang['alpha2'] !== null) {
                continue;
            }

            yield [
                null,
                $lang['alpha3'],
            ];
        }
    }

    public static function getLangWithAlpha3B(): Generator
    {
        foreach (self::getList() as $lang) {
            if ($lang['alpha3B'] === null) {
                continue;
            }

            yield [
                $lang['alpha3B'],
                $lang['alpha3'],
            ];
        }
    }

    public static function getLangWithoutAlpha3B(): Generator
    {
        foreach (self::getList() as $lang) {
            if ($lang['alpha3B'] !== null) {
                continue;
            }

            yield [
                null,
                $lang['alpha3'],
            ];
        }
    }

    public static function getAllLangs(): Generator
    {
        foreach (self::getList() as $lang) {
            yield [
                $lang['alpha3'],
                $lang['alpha3'],
            ];
        }
    }

    /**
     * @return array<array{
     *     alpha2: non-empty-string|null,
     *     alpha3: non-empty-string,
     *     alpha3B: non-empty-string|null,
     *     name: non-empty-string
     * }>
     */
    private static function getList(): array
    {
        return require __DIR__ . '/../resources/languages.php';
    }
}

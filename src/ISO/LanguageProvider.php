<?php

declare(strict_types=1);

namespace MiBo\Languages\ISO;

use MiBo\Languages\Contracts\LanguageInterface;
use MiBo\Languages\Contracts\LanguageProviderInterface;
use MiBo\Languages\Exceptions\LanguageNotFoundException;

/**
 * Class LanguageProvider
 *
 * @package MiBo\Languages\ISO
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
final class LanguageProvider implements LanguageProviderInterface
{
    /** @var array<string, array<string, \MiBo\Languages\Contracts\LanguageInterface>> */
    private array $languageSearched = [];

    /**
     * @var array<array{
     *     alpha2: non-empty-string|null,
     *     alpha3: non-empty-string,
     *     alpha3B: non-empty-string|null,
     *     name: non-empty-string
     * }>
     */

    private array $languages;

    /**
     * @param array<array{
     *     alpha2: non-empty-string|null,
     *     alpha3: non-empty-string,
     *     alpha3B: non-empty-string|null,
     *     name: non-empty-string
     * }> $languages
     */
    public function __construct(array $languages = [])
    {
        $this->languages = count($languages) === 0 ? require __DIR__ . '/../../resources/languages.php' : $languages;
    }

    /**
     * @inheritDoc
     */
    public function getByAlpha2(string $alpha2): LanguageInterface
    {
        return $this->loadBy('alpha2', $alpha2);
    }

    /**
     * @inheritDoc
     */
    public function getByAlpha3(string $alpha3): LanguageInterface
    {
        return $this->loadBy('alpha3', $alpha3);
    }

    /**
     * @inheritDoc
     */
    public function getByAlpha3B(string $alpha3B): LanguageInterface
    {
        return $this->loadBy('alpha3B', $alpha3B);
    }

    /**
     * @param non-empty-string $key
     * @param non-empty-string $value
     *
     * @return \MiBo\Languages\Contracts\LanguageInterface
     */
    private function loadBy(string $key, string $value): LanguageInterface
    {
        if (isset($this->languageSearched[$key][$value])) {
            return $this->languageSearched[$key][$value];
        }

        foreach ($this->languages as $data) {
            if ($data[$key] !== $value) {
                continue;
            }

            $language = new Language($data['alpha3'], $data['name'], $data['alpha2'], $data['alpha3B']);

            return $this->saveLanguage($language);
        }

        throw new LanguageNotFoundException('Language (' . $value . ') not found.');
    }

    /**
     * Save language to cache.
     *
     * @param \MiBo\Languages\ISO\Language $language
     *
     * @return \MiBo\Languages\ISO\Language
     */
    private function saveLanguage(Language $language): Language
    {
        $this->languageSearched['alpha3'][$language->getAlpha3()] = $language;

        if ($language->hasAlpha2()) {
            $this->languageSearched['alpha2'][$language->getAlpha2()] = $language;
        }

        if ($language->hasAlpha3B()) {
            $this->languageSearched['alpha3B'][$language->getAlpha3B()] = $language;
        }

        return $language;
    }
}

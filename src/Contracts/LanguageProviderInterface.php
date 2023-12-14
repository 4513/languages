<?php

declare(strict_types=1);

namespace MiBo\Languages\Contracts;

/**
 * Class LanguageProviderInterface
 *
 * @package MiBo\Languages\Contracts
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
interface LanguageProviderInterface
{
    /**
     * Searches for language by given alpha2 code.
     *
     * @param non-empty-string $alpha2 ISO 639-1.
     *
     * @return \MiBo\Languages\Contracts\LanguageInterface Language instance.
     *
     * @throws \MiBo\Languages\Exceptions\LanguageNotFoundException If language was not found.
     */
    public function getByAlpha2(string $alpha2): LanguageInterface;

    /**
     * Searches for language by given alpha3 code.
     *
     * @param non-empty-string $alpha3 ISO 639-2/T.
     *
     * @return \MiBo\Languages\Contracts\LanguageInterface Language instance.
     *
     * @throws \MiBo\Languages\Exceptions\LanguageNotFoundException If language was not found.
     */
    public function getByAlpha3(string $alpha3): LanguageInterface;

    /**
     * Searches for language by given alpha3B code.
     *
     * @param non-empty-string $alpha3B ISO 639-2/B.
     *
     * @return \MiBo\Languages\Contracts\LanguageInterface Language instance.
     *
     * @throws \MiBo\Languages\Exceptions\LanguageNotFoundException If language was not found.
     */
    public function getByAlpha3B(string $alpha3B): LanguageInterface;
}

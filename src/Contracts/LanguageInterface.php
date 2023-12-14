<?php

declare(strict_types=1);

namespace MiBo\Languages\Contracts;

use Stringable;

/**
 * Interface LanguageInterface
 *
 * @package MiBo\Languages\Contracts
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
interface LanguageInterface extends Stringable
{
    /**
     * Get alpha-3 code of the language.
     *
     * @return non-empty-string ISO 639-2
     */
    public function getAlpha3(): string;

    /**
     * Get bibliographic alpha-3 code of the language.
     *
     *  While most languages are given one code by the standard, twenty of the languages described have two
     * three-letter codes, a "bibliographic" code (ISO 639-2/B), which is derived from the English name
     * for the language and was a necessary legacy feature, and a "terminological" code (ISO 639-2/T),
     * which is derived from the native name for the language and resembles the language's two-letter code
     * in ISO 639-1. There were originally 22 B codes; scc and scr are now deprecated.
     *
     * @return non-empty-string ISO 639-2/B.
     *
     * @throws \MiBo\Languages\Exceptions\LangDoesNotHaveBibliographicCodeException If the language does not
     *     have a bibliographic code.
     */
    public function getAlpha3B(): string;

    /**
     * Get terminological alpha-3 code of the language.
     *
     *  Terminological (also defined in Set 3): these are the preferred codes (based on native language
     * names, romanized if needed).
     *
     * @return non-empty-string ISO 639-2/T.
     */
    public function getAlpha3T(): string;

    /**
     * Get alpha-2 code of the language.
     *
     * @return non-empty-string ISO 639-1.
     *
     * @throws \MiBo\Languages\Exceptions\LangDoesNotHaveAlpha2Exception If the language does not have a
     *    two-letter code.
     */
    public function getAlpha2(): string;

    /**
     * Get name of the language.
     *
     * @return non-empty-string Name of the language (in English).
     */
    public function getName(): string;

    /**
     * Check if the language is the same as the given one.
     *
     * @param \MiBo\Languages\Contracts\LanguageInterface $language Language to compare with.
     *
     * @return bool True if the languages are the same, false otherwise.
     */
    public function is(self $language): bool;
}

<?php

declare(strict_types=1);

namespace MiBo\Languages\ISO;

use MiBo\Languages\Contracts\LanguageInterface;
use MiBo\Languages\Exceptions\LangDoesNotHaveAlpha2Exception;
use MiBo\Languages\Exceptions\LangDoesNotHaveBibliographicCodeException;

/**
 * Class Language
 *
 * @package MiBo\Languages\ISO
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
final readonly class Language implements LanguageInterface
{
    /** @var non-empty-string */
    private string $alpha3T;

    /** @var non-empty-string */
    private string $name;

    /** @var non-empty-string|null */
    private ?string $alpha2;

    /** @var non-empty-string|null */
    private ?string $alpha3B;

    /**
     * @param non-empty-string $alpha3
     * @param non-empty-string $name
     * @param non-empty-string|null $alpha2
     * @param non-empty-string|null $alpha3B
     */
    public function __construct(string $alpha3, string $name, ?string $alpha2 = null, ?string $alpha3B = null)
    {
        $this->alpha3T = $alpha3;
        $this->name    = $name;
        $this->alpha2  = $alpha2;
        $this->alpha3B = $alpha3B;
    }

    /**
     * @inheritDoc
     */
    public function getAlpha3(): string
    {
        return $this->getAlpha3T();
    }

    /**
     * @inheritDoc
     */
    public function getAlpha3B(): string
    {
        if ($this->alpha3B === null) {
            throw new LangDoesNotHaveBibliographicCodeException($this);
        }

        return $this->alpha3B;
    }

    /**
     * @inheritDoc
     */
    public function getAlpha3T(): string
    {
        return $this->alpha3T;
    }

    /**
     * @inheritDoc
     */
    public function getAlpha2(): string
    {
        if ($this->alpha2 === null) {
            throw new LangDoesNotHaveAlpha2Exception($this);
        }

        return $this->alpha2;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function is(LanguageInterface $language): bool
    {
        return $this->getAlpha3() === $language->getAlpha3();
    }

    /**
     * @return bool Returns true if language has alpha2 code.
     */
    public function hasAlpha2(): bool
    {
        return $this->alpha2 !== null;
    }

    /**
     * @return bool Returns true if language has bibliographic code.
     */
    public function hasAlpha3B(): bool
    {
        return $this->alpha3B !== null;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getAlpha3();
    }
}

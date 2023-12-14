<?php

declare(strict_types=1);

namespace MiBo\Languages\Exceptions;

use Exception;
use MiBo\Languages\Contracts\LanguageInterface;

/**
 * Class LangDoesNotHaveAlpha2Exception
 *
 * @package MiBo\Languages\Exceptions
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
final class LangDoesNotHaveAlpha2Exception extends Exception
{
    public function __construct(LanguageInterface $language)
    {
        parent::__construct('Language \'' . $language->getAlpha3() . '\' does not have alpha2 code.');
    }
}

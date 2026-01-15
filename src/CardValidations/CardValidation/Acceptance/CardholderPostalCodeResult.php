<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\Acceptance;

/**
 * The result of the cardholder postal code match.
 */
enum CardholderPostalCodeResult: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';
}

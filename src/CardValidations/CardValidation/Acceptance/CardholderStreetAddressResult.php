<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\Acceptance;

/**
 * The result of the cardholder street address match.
 */
enum CardholderStreetAddressResult: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';
}

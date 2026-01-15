<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\Acceptance;

/**
 * The result of the cardholder last name match.
 */
enum CardholderLastNameResult: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';

    case PARTIAL_MATCH = 'partial_match';
}

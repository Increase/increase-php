<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\Acceptance;

/**
 * The result of the cardholder full name match.
 */
enum CardholderFullNameResult: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';

    case PARTIAL_MATCH = 'partial_match';
}

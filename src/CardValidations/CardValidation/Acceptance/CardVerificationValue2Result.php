<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\Acceptance;

/**
 * The result of the Card Verification Value 2 match.
 */
enum CardVerificationValue2Result: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';
}

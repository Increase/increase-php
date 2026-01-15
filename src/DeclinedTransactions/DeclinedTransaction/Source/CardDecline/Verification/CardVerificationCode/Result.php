<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Verification\CardVerificationCode;

/**
 * The result of verifying the Card Verification Code.
 */
enum Result: string
{
    case NOT_CHECKED = 'not_checked';

    case MATCH = 'match';

    case NO_MATCH = 'no_match';
}

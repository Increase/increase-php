<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline;

/**
 * This is present if a specific decline reason was given in the real-time decision.
 */
enum RealTimeDecisionReason: string
{
    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case TRANSACTION_NEVER_ALLOWED = 'transaction_never_allowed';

    case EXCEEDS_APPROVAL_LIMIT = 'exceeds_approval_limit';

    case CARD_TEMPORARILY_DISABLED = 'card_temporarily_disabled';

    case SUSPECTED_FRAUD = 'suspected_fraud';

    case OTHER = 'other';
}

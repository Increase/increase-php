<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Decline;

/**
 * The reason the card authorization was declined. This translates to a specific decline code that is sent to the card network.
 */
enum Reason: string
{
    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case TRANSACTION_NEVER_ALLOWED = 'transaction_never_allowed';

    case EXCEEDS_APPROVAL_LIMIT = 'exceeds_approval_limit';

    case CARD_TEMPORARILY_DISABLED = 'card_temporarily_disabled';

    case SUSPECTED_FRAUD = 'suspected_fraud';

    case OTHER = 'other';
}

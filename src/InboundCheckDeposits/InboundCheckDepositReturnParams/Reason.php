<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits\InboundCheckDepositReturnParams;

/**
 * The reason to return the Inbound Check Deposit.
 */
enum Reason: string
{
    case ALTERED_OR_FICTITIOUS = 'altered_or_fictitious';

    case NOT_AUTHORIZED = 'not_authorized';

    case DUPLICATE_PRESENTMENT = 'duplicate_presentment';

    case ENDORSEMENT_MISSING = 'endorsement_missing';

    case ENDORSEMENT_IRREGULAR = 'endorsement_irregular';
}

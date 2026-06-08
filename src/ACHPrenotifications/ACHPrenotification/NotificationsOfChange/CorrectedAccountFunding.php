<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification\NotificationsOfChange;

/**
 * The corrected account funding type that should be used in future ACHs to this account. This is derived from the corrected transaction code.
 */
enum CorrectedAccountFunding: string
{
    case CHECKING = 'checking';

    case SAVINGS = 'savings';

    case LOAN = 'loan';

    case GENERAL_LEDGER = 'general_ledger';
}

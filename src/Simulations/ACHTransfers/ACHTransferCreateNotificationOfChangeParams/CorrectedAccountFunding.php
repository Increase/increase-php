<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams;

/**
 * The corrected account funding type.
 */
enum CorrectedAccountFunding: string
{
    case CHECKING = 'checking';

    case SAVINGS = 'savings';

    case LOAN = 'loan';

    case GENERAL_LEDGER = 'general_ledger';
}

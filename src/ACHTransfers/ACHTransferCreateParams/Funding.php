<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

/**
 * The type of the receiver's bank account.
 */
enum Funding: string
{
    case CHECKING = 'checking';

    case SAVINGS = 'savings';

    case LOAN = 'loan';

    case GENERAL_LEDGER = 'general_ledger';
}

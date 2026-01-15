<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

/**
 * The type of the account to which the transfer will be sent.
 */
enum Funding: string
{
    case CHECKING = 'checking';

    case SAVINGS = 'savings';

    case GENERAL_LEDGER = 'general_ledger';
}

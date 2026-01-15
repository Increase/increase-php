<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccountCreateParams;

/**
 * The type of the destination account. Defaults to `checking`.
 */
enum Funding: string
{
    case CHECKING = 'checking';

    case SAVINGS = 'savings';

    case GENERAL_LEDGER = 'general_ledger';

    case OTHER = 'other';
}

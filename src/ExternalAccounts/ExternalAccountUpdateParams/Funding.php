<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccountUpdateParams;

/**
 * The funding type of the External Account.
 */
enum Funding: string
{
    case CHECKING = 'checking';

    case SAVINGS = 'savings';

    case GENERAL_LEDGER = 'general_ledger';

    case OTHER = 'other';
}

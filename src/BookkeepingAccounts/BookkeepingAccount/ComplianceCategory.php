<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts\BookkeepingAccount;

/**
 * The compliance category of the account.
 */
enum ComplianceCategory: string
{
    case COMMINGLED_CASH = 'commingled_cash';

    case CUSTOMER_BALANCE = 'customer_balance';
}

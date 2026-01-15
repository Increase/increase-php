<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts\BookkeepingAccountCreateParams;

/**
 * The account compliance category.
 */
enum ComplianceCategory: string
{
    case COMMINGLED_CASH = 'commingled_cash';

    case CUSTOMER_BALANCE = 'customer_balance';
}

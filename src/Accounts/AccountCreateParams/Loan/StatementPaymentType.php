<?php

declare(strict_types=1);

namespace Increase\Accounts\AccountCreateParams\Loan;

/**
 * The type of statement payment for the account.
 */
enum StatementPaymentType: string
{
    case BALANCE = 'balance';

    case INTEREST_UNTIL_MATURITY = 'interest_until_maturity';
}

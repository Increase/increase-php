<?php

declare(strict_types=1);

namespace Increase\Accounts\Account\Loan;

/**
 * The type of payment for the loan.
 */
enum StatementPaymentType: string
{
    case BALANCE = 'balance';

    case INTEREST_UNTIL_MATURITY = 'interest_until_maturity';
}

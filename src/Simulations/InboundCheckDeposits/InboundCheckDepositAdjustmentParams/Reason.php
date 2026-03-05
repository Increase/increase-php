<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundCheckDeposits\InboundCheckDepositAdjustmentParams;

/**
 * The reason for the adjustment. Defaults to `wrong_payee_credit`.
 */
enum Reason: string
{
    case LATE_RETURN = 'late_return';

    case WRONG_PAYEE_CREDIT = 'wrong_payee_credit';

    case ADJUSTED_AMOUNT = 'adjusted_amount';

    case NON_CONFORMING_ITEM = 'non_conforming_item';

    case PAID = 'paid';
}

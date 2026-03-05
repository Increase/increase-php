<?php

declare(strict_types=1);

namespace Increase\Simulations\CheckDeposits\CheckDepositAdjustmentParams;

/**
 * The reason for the adjustment. Defaults to `non_conforming_item`, which is often used for a low quality image that the recipient wasn't able to handle.
 */
enum Reason: string
{
    case LATE_RETURN = 'late_return';

    case WRONG_PAYEE_CREDIT = 'wrong_payee_credit';

    case ADJUSTED_AMOUNT = 'adjusted_amount';

    case NON_CONFORMING_ITEM = 'non_conforming_item';

    case PAID = 'paid';
}

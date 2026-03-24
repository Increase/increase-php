<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit\DepositAdjustment;

/**
 * The reason for the adjustment.
 */
enum Reason: string
{
    case ADJUSTED_AMOUNT = 'adjusted_amount';

    case NON_CONFORMING_ITEM = 'non_conforming_item';

    case PAID = 'paid';
}

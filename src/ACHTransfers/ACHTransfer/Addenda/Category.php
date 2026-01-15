<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer\Addenda;

/**
 * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case FREEFORM = 'freeform';

    case PAYMENT_ORDER_REMITTANCE_ADVICE = 'payment_order_remittance_advice';

    case OTHER = 'other';
}

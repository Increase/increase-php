<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams\Addenda;

/**
 * The type of addenda to pass with the transfer.
 */
enum Category: string
{
    case FREEFORM = 'freeform';

    case PAYMENT_ORDER_REMITTANCE_ADVICE = 'payment_order_remittance_advice';
}

<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\StopPaymentRequest;

/**
 * A constant representing the object's type. For this resource it will always be `check_transfer_stop_payment_request`.
 */
enum Type: string
{
    case CHECK_TRANSFER_STOP_PAYMENT_REQUEST = 'check_transfer_stop_payment_request';
}

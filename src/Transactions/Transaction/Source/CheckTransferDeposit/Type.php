<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CheckTransferDeposit;

/**
 * A constant representing the object's type. For this resource it will always be `check_transfer_deposit`.
 */
enum Type: string
{
    case CHECK_TRANSFER_DEPOSIT = 'check_transfer_deposit';
}

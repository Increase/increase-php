<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\InboundFednowTransferReturn;

/**
 * The reason for the return.
 */
enum Reason: string
{
    case DUPLICATE = 'duplicate';

    case CREDITOR_REQUEST = 'creditor_request';

    case WRONG_AMOUNT = 'wrong_amount';

    case UNDUE_PAYMENT = 'undue_payment';

    case FRAUD = 'fraud';
}

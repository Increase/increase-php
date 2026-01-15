<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers\InboundWireTransferReverseParams;

/**
 * Reason for the reversal.
 */
enum Reason: string
{
    case DUPLICATE = 'duplicate';

    case CREDITOR_REQUEST = 'creditor_request';

    case TRANSACTION_FORBIDDEN = 'transaction_forbidden';
}

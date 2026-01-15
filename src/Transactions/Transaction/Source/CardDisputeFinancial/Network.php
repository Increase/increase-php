<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardDisputeFinancial;

/**
 * The network that the Card Dispute is associated with.
 */
enum Network: string
{
    case VISA = 'visa';

    case PULSE = 'pulse';
}

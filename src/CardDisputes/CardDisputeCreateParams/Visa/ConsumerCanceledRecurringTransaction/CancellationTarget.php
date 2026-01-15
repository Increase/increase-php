<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction;

/**
 * Cancellation target.
 */
enum CancellationTarget: string
{
    case ACCOUNT = 'account';

    case TRANSACTION = 'transaction';
}

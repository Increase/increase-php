<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\CardholderCancellation;

/**
 * Cancellation policy provided.
 */
enum CancellationPolicyProvided: string
{
    case NOT_PROVIDED = 'not_provided';

    case PROVIDED = 'provided';
}

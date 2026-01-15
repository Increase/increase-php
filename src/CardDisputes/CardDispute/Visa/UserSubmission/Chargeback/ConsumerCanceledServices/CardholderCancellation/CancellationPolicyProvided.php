<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\CardholderCancellation;

/**
 * Cancellation policy provided.
 */
enum CancellationPolicyProvided: string
{
    case NOT_PROVIDED = 'not_provided';

    case PROVIDED = 'provided';
}

<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError;

/**
 * Error reason.
 */
enum ErrorReason: string
{
    case DUPLICATE_TRANSACTION = 'duplicate_transaction';

    case INCORRECT_AMOUNT = 'incorrect_amount';

    case PAID_BY_OTHER_MEANS = 'paid_by_other_means';
}

<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerOriginalCreditTransactionNotAccepted;

/**
 * Reason.
 */
enum Reason: string
{
    case PROHIBITED_BY_LOCAL_LAWS_OR_REGULATION = 'prohibited_by_local_laws_or_regulation';

    case RECIPIENT_REFUSED = 'recipient_refused';
}

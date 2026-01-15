<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\Authorization;

/**
 * Account status.
 */
enum AccountStatus: string
{
    case ACCOUNT_CLOSED = 'account_closed';

    case CREDIT_PROBLEM = 'credit_problem';

    case FRAUD = 'fraud';
}

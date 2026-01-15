<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\Authorization;

/**
 * Account status.
 */
enum AccountStatus: string
{
    case ACCOUNT_CLOSED = 'account_closed';

    case CREDIT_PROBLEM = 'credit_problem';

    case FRAUD = 'fraud';
}

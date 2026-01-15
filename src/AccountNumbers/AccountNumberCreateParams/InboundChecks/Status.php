<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks;

/**
 * How Increase should process checks with this account number printed on them. If you do not specify this field, the default is `check_transfers_only`.
 */
enum Status: string
{
    case ALLOWED = 'allowed';

    case CHECK_TRANSFERS_ONLY = 'check_transfers_only';
}

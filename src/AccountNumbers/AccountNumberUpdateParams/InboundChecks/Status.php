<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberUpdateParams\InboundChecks;

/**
 * How Increase should process checks with this account number printed on them.
 */
enum Status: string
{
    case ALLOWED = 'allowed';

    case CHECK_TRANSFERS_ONLY = 'check_transfers_only';
}

<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumber;

/**
 * Whether inbound ACH debits are allowed against this Account Number. Note that they will still be declined if this is `allowed` but the Account Number is not active.
 */
enum InboundACHDebits: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}

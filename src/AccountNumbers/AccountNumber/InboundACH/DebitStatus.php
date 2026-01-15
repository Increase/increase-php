<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumber\InboundACH;

/**
 * Whether ACH debits are allowed against this Account Number. Note that they will still be declined if this is `allowed` if the Account Number is not active.
 */
enum DebitStatus: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}

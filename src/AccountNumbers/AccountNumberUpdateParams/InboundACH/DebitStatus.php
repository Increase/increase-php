<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH;

/**
 * Whether ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active.
 */
enum DebitStatus: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}

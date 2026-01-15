<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberCreateParams\InboundACH;

/**
 * Whether ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active. If you do not specify this field, the default is `allowed`.
 */
enum DebitStatus: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}

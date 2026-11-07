<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberCreateParams;

/**
 * Whether unregistered inbound checks for this Account Number can be deposited. If you do not specify this field, the default is `blocked`.
 */
enum UnregisteredInboundChecks: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}

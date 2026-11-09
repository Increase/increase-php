<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumber;

/**
 * Whether unregistered inbound checks for this Account Number can be deposited.
 */
enum UnregisteredInboundChecks: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}

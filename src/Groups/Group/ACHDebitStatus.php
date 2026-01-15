<?php

declare(strict_types=1);

namespace Increase\Groups\Group;

/**
 * If the Group is allowed to create ACH debits.
 */
enum ACHDebitStatus: string
{
    case DISABLED = 'disabled';

    case ENABLED = 'enabled';
}

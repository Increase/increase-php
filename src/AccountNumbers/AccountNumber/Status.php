<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumber;

/**
 * This indicates if payments can be made to the Account Number.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}

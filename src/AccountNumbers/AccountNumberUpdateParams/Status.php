<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberUpdateParams;

/**
 * This indicates if transfers can be made to the Account Number.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}

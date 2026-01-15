<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

/**
 * The type of entity that owns the account to which the ACH Transfer is being sent.
 */
enum DestinationAccountHolder: string
{
    case BUSINESS = 'business';

    case INDIVIDUAL = 'individual';

    case UNKNOWN = 'unknown';
}

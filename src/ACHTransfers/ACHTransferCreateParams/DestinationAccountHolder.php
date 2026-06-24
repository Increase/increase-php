<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

/**
 * The type of entity that owns the receiver's account.
 */
enum DestinationAccountHolder: string
{
    case BUSINESS = 'business';

    case INDIVIDUAL = 'individual';

    case UNKNOWN = 'unknown';
}

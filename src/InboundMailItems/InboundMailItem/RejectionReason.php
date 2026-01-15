<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItem;

/**
 * If the mail item has been rejected, why it was rejected.
 */
enum RejectionReason: string
{
    case NO_MATCHING_LOCKBOX = 'no_matching_lockbox';

    case NO_CHECK = 'no_check';

    case LOCKBOX_NOT_ACTIVE = 'lockbox_not_active';
}

<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscription;

/**
 * This indicates if we'll send notifications to this subscription.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case DELETED = 'deleted';

    case REQUIRES_ATTENTION = 'requires_attention';
}

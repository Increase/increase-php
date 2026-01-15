<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscriptionUpdateParams;

/**
 * The status to update the Event Subscription with.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case DELETED = 'deleted';
}

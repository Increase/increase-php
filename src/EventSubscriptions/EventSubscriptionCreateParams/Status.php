<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscriptionCreateParams;

/**
 * The status of the event subscription. Defaults to `active` if not specified.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';
}

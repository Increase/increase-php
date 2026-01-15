<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscription;

/**
 * A constant representing the object's type. For this resource it will always be `event_subscription`.
 */
enum Type: string
{
    case EVENT_SUBSCRIPTION = 'event_subscription';
}

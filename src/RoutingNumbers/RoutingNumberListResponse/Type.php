<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * A constant representing the object's type. For this resource it will always be `routing_number`.
 */
enum Type: string
{
    case ROUTING_NUMBER = 'routing_number';
}

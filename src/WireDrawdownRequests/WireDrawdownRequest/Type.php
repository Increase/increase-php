<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * A constant representing the object's type. For this resource it will always be `wire_drawdown_request`.
 */
enum Type: string
{
    case WIRE_DRAWDOWN_REQUEST = 'wire_drawdown_request';
}

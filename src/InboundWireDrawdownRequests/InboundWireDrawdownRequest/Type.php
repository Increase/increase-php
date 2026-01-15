<?php

declare(strict_types=1);

namespace Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_wire_drawdown_request`.
 */
enum Type: string
{
    case INBOUND_WIRE_DRAWDOWN_REQUEST = 'inbound_wire_drawdown_request';
}

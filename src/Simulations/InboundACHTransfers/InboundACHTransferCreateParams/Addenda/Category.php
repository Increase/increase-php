<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda;

/**
 * The type of addenda to simulate being sent with the transfer.
 */
enum Category: string
{
    case FREEFORM = 'freeform';
}

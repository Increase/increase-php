<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer\Addenda;

/**
 * The type of addendum.
 */
enum Category: string
{
    case FREEFORM = 'freeform';
}

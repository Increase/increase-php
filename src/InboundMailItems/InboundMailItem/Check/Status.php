<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItem\Check;

/**
 * The status of the Inbound Mail Item Check.
 */
enum Status: string
{
    case PENDING = 'pending';

    case DEPOSITED = 'deposited';

    case IGNORED = 'ignored';
}

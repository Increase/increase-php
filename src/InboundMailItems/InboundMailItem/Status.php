<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItem;

/**
 * If the mail item has been processed.
 */
enum Status: string
{
    case PENDING = 'pending';

    case PROCESSED = 'processed';

    case REJECTED = 'rejected';
}

<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches\PhysicalCheckBatch;

/**
 * The lifecycle status of the Physical Check Batch.
 */
enum Status: string
{
    case PENDING = 'pending';

    case COMPLETED = 'completed';

    case CANCELED = 'canceled';

    case REQUIRES_ATTENTION = 'requires_attention';
}

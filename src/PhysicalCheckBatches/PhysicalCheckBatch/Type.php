<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches\PhysicalCheckBatch;

/**
 * A constant representing the object's type. For this resource it will always be `physical_check_batch`.
 */
enum Type: string
{
    case PHYSICAL_CHECK_BATCH = 'physical_check_batch';
}

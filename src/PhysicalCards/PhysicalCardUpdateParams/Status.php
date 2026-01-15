<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCardUpdateParams;

/**
 * The status to update the Physical Card to.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}

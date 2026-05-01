<?php

declare(strict_types=1);

namespace Increase\Simulations\Entities\EntityValidationParams;

/**
 * The status to set on the new managed compliance validation.
 */
enum Status: string
{
    case VALID = 'valid';

    case INVALID = 'invalid';

    case PENDING = 'pending';
}

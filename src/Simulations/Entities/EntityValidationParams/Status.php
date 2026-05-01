<?php

declare(strict_types=1);

namespace Increase\Simulations\Entities\EntityValidationParams;

/**
 * The validation status to set on the Entity.
 */
enum Status: string
{
    case VALID = 'valid';

    case INVALID = 'invalid';

    case PENDING = 'pending';
}

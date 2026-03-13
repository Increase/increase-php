<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation;

/**
 * The validation status for the entity. If the status is `invalid`, the `issues` array will be populated.
 */
enum Status: string
{
    case PENDING = 'pending';

    case VALID = 'valid';

    case INVALID = 'invalid';
}

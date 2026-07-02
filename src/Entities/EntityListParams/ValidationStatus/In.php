<?php

declare(strict_types=1);

namespace Increase\Entities\EntityListParams\ValidationStatus;

enum In: string
{
    case PENDING = 'pending';

    case VALID = 'valid';

    case INVALID = 'invalid';
}

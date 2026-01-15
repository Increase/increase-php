<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams;

/**
 * The type of Entity to create.
 */
enum Structure: string
{
    case CORPORATION = 'corporation';

    case NATURAL_PERSON = 'natural_person';

    case JOINT = 'joint';

    case TRUST = 'trust';

    case GOVERNMENT_AUTHORITY = 'government_authority';
}

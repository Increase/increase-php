<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

/**
 * The entity's legal structure.
 */
enum Structure: string
{
    case CORPORATION = 'corporation';

    case NATURAL_PERSON = 'natural_person';

    case JOINT = 'joint';

    case TRUST = 'trust';

    case GOVERNMENT_AUTHORITY = 'government_authority';
}

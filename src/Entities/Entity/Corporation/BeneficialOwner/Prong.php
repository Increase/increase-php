<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Corporation\BeneficialOwner;

/**
 * Why this person is considered a beneficial owner of the entity.
 */
enum Prong: string
{
    case OWNERSHIP = 'ownership';

    case CONTROL = 'control';
}

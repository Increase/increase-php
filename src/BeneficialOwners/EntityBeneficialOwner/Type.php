<?php

declare(strict_types=1);

namespace Increase\BeneficialOwners\EntityBeneficialOwner;

/**
 * A constant representing the object's type. For this resource it will always be `entity_beneficial_owner`.
 */
enum Type: string
{
    case ENTITY_BENEFICIAL_OWNER = 'entity_beneficial_owner';
}

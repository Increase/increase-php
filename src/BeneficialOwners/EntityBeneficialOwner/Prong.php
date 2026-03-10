<?php

declare(strict_types=1);

namespace Increase\BeneficialOwners\EntityBeneficialOwner;

enum Prong: string
{
    case OWNERSHIP = 'ownership';

    case CONTROL = 'control';
}

<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateBeneficialOwnerParams\BeneficialOwner;

enum Prong: string
{
    case OWNERSHIP = 'ownership';

    case CONTROL = 'control';
}

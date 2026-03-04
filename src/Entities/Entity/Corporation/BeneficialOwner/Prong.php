<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Corporation\BeneficialOwner;

enum Prong: string
{
    case OWNERSHIP = 'ownership';

    case CONTROL = 'control';
}

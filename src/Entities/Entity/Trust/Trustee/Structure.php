<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Trust\Trustee;

/**
 * The structure of the trustee. Will always be equal to `individual`.
 */
enum Structure: string
{
    case INDIVIDUAL = 'individual';
}

<?php

declare(strict_types=1);

namespace Increase\IntrafiExclusions\IntrafiExclusion;

/**
 * A constant representing the object's type. For this resource it will always be `intrafi_exclusion`.
 */
enum Type: string
{
    case INTRAFI_EXCLUSION = 'intrafi_exclusion';
}

<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles\PhysicalCardProfile;

/**
 * The creator of this Physical Card Profile.
 */
enum Creator: string
{
    case INCREASE = 'increase';

    case USER = 'user';
}

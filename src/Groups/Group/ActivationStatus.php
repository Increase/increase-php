<?php

declare(strict_types=1);

namespace Increase\Groups\Group;

/**
 * If the Group is activated or not.
 */
enum ActivationStatus: string
{
    case UNACTIVATED = 'unactivated';

    case ACTIVATED = 'activated';
}

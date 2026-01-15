<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams;

/**
 * The status to update the Card with.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}

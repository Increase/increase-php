<?php

declare(strict_types=1);

namespace Increase\Events\EventListParams\OrderBy;

/**
 * The direction to order in.
 */
enum Direction: string
{
    case ASCENDING = 'ascending';

    case DESCENDING = 'descending';
}

<?php

declare(strict_types=1);

namespace Increase\Events\EventListParams\OrderBy;

/**
 * The field to order by.
 */
enum Field: string
{
    case CREATED_AT = 'created_at';
}

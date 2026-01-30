<?php

declare(strict_types=1);

namespace Increase\IntrafiExclusions\IntrafiExclusion;

/**
 * The status of the exclusion request.
 */
enum Status: string
{
    case PENDING = 'pending';

    case COMPLETED = 'completed';

    case ARCHIVED = 'archived';

    case INELIGIBLE = 'ineligible';
}

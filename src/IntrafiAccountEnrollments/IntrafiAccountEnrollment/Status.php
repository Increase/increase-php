<?php

declare(strict_types=1);

namespace Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment;

/**
 * The status of the account in the network. An account takes about one business day to go from `pending_enrolling` to `enrolled`.
 */
enum Status: string
{
    case PENDING_ENROLLING = 'pending_enrolling';

    case ENROLLED = 'enrolled';

    case PENDING_UNENROLLING = 'pending_unenrolling';

    case UNENROLLED = 'unenrolled';

    case REQUIRES_ATTENTION = 'requires_attention';
}

<?php

declare(strict_types=1);

namespace Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status;

enum In: string
{
    case PENDING_ENROLLING = 'pending_enrolling';

    case ENROLLED = 'enrolled';

    case PENDING_UNENROLLING = 'pending_unenrolling';

    case UNENROLLED = 'unenrolled';

    case REQUIRES_ATTENTION = 'requires_attention';
}

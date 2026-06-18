<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification;

/**
 * The lifecycle status of the ACH Prenotification.
 */
enum Status: string
{
    case PENDING_SUBMITTING = 'pending_submitting';

    case RETURNED = 'returned';

    case SUBMITTED = 'submitted';

    case REQUIRES_ATTENTION = 'requires_attention';
}

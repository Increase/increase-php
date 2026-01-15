<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission;

/**
 * The status of the Visa Card Dispute User Submission.
 */
enum Status: string
{
    case ABANDONED = 'abandoned';

    case ACCEPTED = 'accepted';

    case FURTHER_INFORMATION_REQUESTED = 'further_information_requested';

    case PENDING_REVIEWING = 'pending_reviewing';
}

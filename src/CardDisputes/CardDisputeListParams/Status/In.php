<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeListParams\Status;

enum In: string
{
    case USER_SUBMISSION_REQUIRED = 'user_submission_required';

    case PENDING_USER_SUBMISSION_REVIEWING = 'pending_user_submission_reviewing';

    case PENDING_USER_SUBMISSION_SUBMITTING = 'pending_user_submission_submitting';

    case PENDING_USER_WITHDRAWAL_SUBMITTING = 'pending_user_withdrawal_submitting';

    case PENDING_RESPONSE = 'pending_response';

    case LOST = 'lost';

    case WON = 'won';
}

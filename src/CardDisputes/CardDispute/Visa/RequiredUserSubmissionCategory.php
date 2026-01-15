<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa;

/**
 * The category of the currently required user submission if the user wishes to proceed with the dispute. Present if and only if status is `user_submission_required`. Otherwise, this will be `nil`.
 */
enum RequiredUserSubmissionCategory: string
{
    case CHARGEBACK = 'chargeback';

    case MERCHANT_PREARBITRATION_DECLINE = 'merchant_prearbitration_decline';

    case USER_PREARBITRATION = 'user_prearbitration';
}

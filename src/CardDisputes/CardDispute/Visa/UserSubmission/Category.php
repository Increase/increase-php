<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission;

/**
 * The category of the user submission. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case CHARGEBACK = 'chargeback';

    case MERCHANT_PREARBITRATION_DECLINE = 'merchant_prearbitration_decline';

    case USER_PREARBITRATION = 'user_prearbitration';
}

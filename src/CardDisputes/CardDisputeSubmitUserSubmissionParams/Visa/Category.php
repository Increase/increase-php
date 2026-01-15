<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa;

/**
 * The category of the user submission. Details specific to the category are required under the sub-object with the same identifier as the category.
 */
enum Category: string
{
    case CHARGEBACK = 'chargeback';

    case MERCHANT_PREARBITRATION_DECLINE = 'merchant_prearbitration_decline';

    case USER_PREARBITRATION = 'user_prearbitration';
}

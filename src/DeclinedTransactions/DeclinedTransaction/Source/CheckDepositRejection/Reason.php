<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDepositRejection;

/**
 * Why the check deposit was rejected.
 */
enum Reason: string
{
    case INCOMPLETE_IMAGE = 'incomplete_image';

    case DUPLICATE = 'duplicate';

    case POOR_IMAGE_QUALITY = 'poor_image_quality';

    case INCORRECT_AMOUNT = 'incorrect_amount';

    case INCORRECT_RECIPIENT = 'incorrect_recipient';

    case NOT_ELIGIBLE_FOR_MOBILE_DEPOSIT = 'not_eligible_for_mobile_deposit';

    case MISSING_REQUIRED_DATA_ELEMENTS = 'missing_required_data_elements';

    case SUSPECTED_FRAUD = 'suspected_fraud';

    case DEPOSIT_WINDOW_EXPIRED = 'deposit_window_expired';

    case REQUESTED_BY_USER = 'requested_by_user';

    case UNKNOWN = 'unknown';
}

<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

/**
 * The category of the user submission. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case CHARGEBACK_ACCEPTED = 'chargeback_accepted';

    case CHARGEBACK_SUBMITTED = 'chargeback_submitted';

    case CHARGEBACK_TIMED_OUT = 'chargeback_timed_out';

    case MERCHANT_PREARBITRATION_DECLINE_SUBMITTED = 'merchant_prearbitration_decline_submitted';

    case MERCHANT_PREARBITRATION_RECEIVED = 'merchant_prearbitration_received';

    case MERCHANT_PREARBITRATION_TIMED_OUT = 'merchant_prearbitration_timed_out';

    case REPRESENTED = 'represented';

    case REPRESENTMENT_TIMED_OUT = 'representment_timed_out';

    case USER_PREARBITRATION_ACCEPTED = 'user_prearbitration_accepted';

    case USER_PREARBITRATION_DECLINED = 'user_prearbitration_declined';

    case USER_PREARBITRATION_SUBMITTED = 'user_prearbitration_submitted';

    case USER_PREARBITRATION_TIMED_OUT = 'user_prearbitration_timed_out';

    case USER_WITHDRAWAL_SUBMITTED = 'user_withdrawal_submitted';
}

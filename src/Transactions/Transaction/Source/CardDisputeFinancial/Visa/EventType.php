<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardDisputeFinancial\Visa;

/**
 * The type of card dispute financial event.
 */
enum EventType: string
{
    case CHARGEBACK_SUBMITTED = 'chargeback_submitted';

    case MERCHANT_PREARBITRATION_DECLINE_SUBMITTED = 'merchant_prearbitration_decline_submitted';

    case MERCHANT_PREARBITRATION_RECEIVED = 'merchant_prearbitration_received';

    case REPRESENTED = 'represented';

    case USER_PREARBITRATION_DECLINE_RECEIVED = 'user_prearbitration_decline_received';

    case USER_PREARBITRATION_SUBMITTED = 'user_prearbitration_submitted';

    case USER_WITHDRAWAL_SUBMITTED = 'user_withdrawal_submitted';
}

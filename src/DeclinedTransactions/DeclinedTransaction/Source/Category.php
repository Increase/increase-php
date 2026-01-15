<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

/**
 * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case ACH_DECLINE = 'ach_decline';

    case CARD_DECLINE = 'card_decline';

    case CHECK_DECLINE = 'check_decline';

    case INBOUND_REAL_TIME_PAYMENTS_TRANSFER_DECLINE = 'inbound_real_time_payments_transfer_decline';

    case INBOUND_FEDNOW_TRANSFER_DECLINE = 'inbound_fednow_transfer_decline';

    case WIRE_DECLINE = 'wire_decline';

    case CHECK_DEPOSIT_REJECTION = 'check_deposit_rejection';

    case OTHER = 'other';
}

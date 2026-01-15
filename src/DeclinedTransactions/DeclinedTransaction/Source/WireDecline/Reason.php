<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\WireDecline;

/**
 * Why the wire transfer was declined.
 */
enum Reason: string
{
    case ACCOUNT_NUMBER_CANCELED = 'account_number_canceled';

    case ACCOUNT_NUMBER_DISABLED = 'account_number_disabled';

    case ENTITY_NOT_ACTIVE = 'entity_not_active';

    case GROUP_LOCKED = 'group_locked';

    case NO_ACCOUNT_NUMBER = 'no_account_number';

    case TRANSACTION_NOT_ALLOWED = 'transaction_not_allowed';
}

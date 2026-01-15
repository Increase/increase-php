<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundFednowTransferDecline;

/**
 * Why the transfer was declined.
 */
enum Reason: string
{
    case ACCOUNT_NUMBER_CANCELED = 'account_number_canceled';

    case ACCOUNT_NUMBER_DISABLED = 'account_number_disabled';

    case ACCOUNT_RESTRICTED = 'account_restricted';

    case GROUP_LOCKED = 'group_locked';

    case ENTITY_NOT_ACTIVE = 'entity_not_active';

    case FEDNOW_NOT_ENABLED = 'fednow_not_enabled';
}

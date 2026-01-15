<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Travel;

/**
 * Indicates why a ticket was changed.
 */
enum TicketChangeIndicator: string
{
    case NONE = 'none';

    case CHANGE_TO_EXISTING_TICKET = 'change_to_existing_ticket';

    case NEW_TICKET = 'new_ticket';
}

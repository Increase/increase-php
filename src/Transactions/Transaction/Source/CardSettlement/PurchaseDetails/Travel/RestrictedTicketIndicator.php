<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel;

/**
 * Indicates whether this ticket is non-refundable.
 */
enum RestrictedTicketIndicator: string
{
    case NO_RESTRICTIONS = 'no_restrictions';

    case RESTRICTED_NON_REFUNDABLE_TICKET = 'restricted_non_refundable_ticket';
}

<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Travel;

/**
 * Indicates the reason for a credit to the cardholder.
 */
enum CreditReasonIndicator: string
{
    case NO_CREDIT = 'no_credit';

    case PASSENGER_TRANSPORT_ANCILLARY_PURCHASE_CANCELLATION = 'passenger_transport_ancillary_purchase_cancellation';

    case AIRLINE_TICKET_AND_PASSENGER_TRANSPORT_ANCILLARY_PURCHASE_CANCELLATION = 'airline_ticket_and_passenger_transport_ancillary_purchase_cancellation';

    case AIRLINE_TICKET_CANCELLATION = 'airline_ticket_cancellation';

    case OTHER = 'other';

    case PARTIAL_REFUND_OF_AIRLINE_TICKET = 'partial_refund_of_airline_ticket';
}

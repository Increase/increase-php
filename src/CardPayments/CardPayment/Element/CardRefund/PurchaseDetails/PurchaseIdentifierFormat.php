<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails;

/**
 * The format of the purchase identifier.
 */
enum PurchaseIdentifierFormat: string
{
    case FREE_TEXT = 'free_text';

    case ORDER_NUMBER = 'order_number';

    case RENTAL_AGREEMENT_NUMBER = 'rental_agreement_number';

    case HOTEL_FOLIO_NUMBER = 'hotel_folio_number';

    case INVOICE_NUMBER = 'invoice_number';
}

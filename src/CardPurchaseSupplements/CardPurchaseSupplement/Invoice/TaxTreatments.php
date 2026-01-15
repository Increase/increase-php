<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement\Invoice;

/**
 * Indicates how the merchant applied taxes.
 */
enum TaxTreatments: string
{
    case NO_TAX_APPLIES = 'no_tax_applies';

    case NET_PRICE_LINE_ITEM_LEVEL = 'net_price_line_item_level';

    case NET_PRICE_INVOICE_LEVEL = 'net_price_invoice_level';

    case GROSS_PRICE_LINE_ITEM_LEVEL = 'gross_price_line_item_level';

    case GROSS_PRICE_INVOICE_LEVEL = 'gross_price_invoice_level';
}

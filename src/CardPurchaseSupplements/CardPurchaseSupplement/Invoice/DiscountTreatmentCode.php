<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement\Invoice;

/**
 * Indicates how the merchant applied the discount.
 */
enum DiscountTreatmentCode: string
{
    case NO_INVOICE_LEVEL_DISCOUNT_PROVIDED = 'no_invoice_level_discount_provided';

    case TAX_CALCULATED_ON_POST_DISCOUNT_INVOICE_TOTAL = 'tax_calculated_on_post_discount_invoice_total';

    case TAX_CALCULATED_ON_PRE_DISCOUNT_INVOICE_TOTAL = 'tax_calculated_on_pre_discount_invoice_total';
}

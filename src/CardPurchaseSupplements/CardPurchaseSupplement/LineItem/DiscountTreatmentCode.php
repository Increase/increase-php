<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement\LineItem;

/**
 * Indicates how the merchant applied the discount for this specific line item.
 */
enum DiscountTreatmentCode: string
{
    case NO_LINE_ITEM_LEVEL_DISCOUNT_PROVIDED = 'no_line_item_level_discount_provided';

    case TAX_CALCULATED_ON_POST_DISCOUNT_LINE_ITEM_TOTAL = 'tax_calculated_on_post_discount_line_item_total';

    case TAX_CALCULATED_ON_PRE_DISCOUNT_LINE_ITEM_TOTAL = 'tax_calculated_on_pre_discount_line_item_total';
}

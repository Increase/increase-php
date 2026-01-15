<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Lodging;

/**
 * Additional charges (phone, late check-out, etc.) being billed.
 */
enum ExtraCharges: string
{
    case NO_EXTRA_CHARGE = 'no_extra_charge';

    case RESTAURANT = 'restaurant';

    case GIFT_SHOP = 'gift_shop';

    case MINI_BAR = 'mini_bar';

    case TELEPHONE = 'telephone';

    case OTHER = 'other';

    case LAUNDRY = 'laundry';
}

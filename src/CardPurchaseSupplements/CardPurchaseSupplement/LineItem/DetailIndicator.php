<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement\LineItem;

/**
 * Indicates the type of line item.
 */
enum DetailIndicator: string
{
    case NORMAL = 'normal';

    case CREDIT = 'credit';

    case PAYMENT = 'payment';
}

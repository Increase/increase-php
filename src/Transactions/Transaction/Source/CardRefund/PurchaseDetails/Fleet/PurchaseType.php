<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Fleet;

/**
 * The type of fleet purchase.
 */
enum PurchaseType: string
{
    case FUEL_PURCHASE = 'fuel_purchase';

    case NON_FUEL_PURCHASE = 'non_fuel_purchase';

    case FUEL_AND_NON_FUEL_PURCHASE = 'fuel_and_non_fuel_purchase';

    case FUEL_PURCHASE_WITH_MULTIPLE_FUEL_TYPES = 'fuel_purchase_with_multiple_fuel_types';
}

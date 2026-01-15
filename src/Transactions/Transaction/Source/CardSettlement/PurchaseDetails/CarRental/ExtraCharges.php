<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\CarRental;

/**
 * Additional charges (gas, late fee, etc.) being billed.
 */
enum ExtraCharges: string
{
    case NO_EXTRA_CHARGE = 'no_extra_charge';

    case GAS = 'gas';

    case EXTRA_MILEAGE = 'extra_mileage';

    case LATE_RETURN = 'late_return';

    case ONE_WAY_SERVICE_FEE = 'one_way_service_fee';

    case PARKING_VIOLATION = 'parking_violation';
}

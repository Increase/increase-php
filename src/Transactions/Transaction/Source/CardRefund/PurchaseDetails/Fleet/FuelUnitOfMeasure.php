<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Fleet;

/**
 * The unit of measure for the fuel quantity.
 */
enum FuelUnitOfMeasure: string
{
    case LITER = 'liter';

    case US_GALLON = 'us_gallon';

    case IMPERIAL_GALLON = 'imperial_gallon';

    case KILOGRAM = 'kilogram';

    case POUND = 'pound';

    case CHARGING_MINUTES = 'charging_minutes';

    case KILOWATT_HOUR = 'kilowatt_hour';
}

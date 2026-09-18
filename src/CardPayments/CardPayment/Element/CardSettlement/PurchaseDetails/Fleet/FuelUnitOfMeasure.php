<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Fleet;

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
}

<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\CarRental;

/**
 * An indicator that the cardholder is being billed for a reserved vehicle that was not actually rented (that is, a "no-show" charge).
 */
enum NoShowIndicator: string
{
    case NOT_APPLICABLE = 'not_applicable';

    case NO_SHOW_FOR_SPECIALIZED_VEHICLE = 'no_show_for_specialized_vehicle';
}

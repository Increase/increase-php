<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Lodging;

/**
 * Indicator that the cardholder is being billed for a reserved room that was not actually used.
 */
enum NoShowIndicator: string
{
    case NOT_APPLICABLE = 'not_applicable';

    case NO_SHOW = 'no_show';
}

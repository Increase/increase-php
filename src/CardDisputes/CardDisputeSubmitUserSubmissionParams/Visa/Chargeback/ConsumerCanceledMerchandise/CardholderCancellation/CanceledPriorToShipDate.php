<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation;

/**
 * Canceled prior to ship date.
 */
enum CanceledPriorToShipDate: string
{
    case CANCELED_PRIOR_TO_SHIP_DATE = 'canceled_prior_to_ship_date';

    case NOT_CANCELED_PRIOR_TO_SHIP_DATE = 'not_canceled_prior_to_ship_date';
}

<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledServices;

/**
 * Service type.
 */
enum ServiceType: string
{
    case GUARANTEED_RESERVATION = 'guaranteed_reservation';

    case OTHER = 'other';

    case TIMESHARE = 'timeshare';
}

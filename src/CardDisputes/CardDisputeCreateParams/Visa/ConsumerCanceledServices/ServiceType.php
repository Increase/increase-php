<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices;

/**
 * Service type.
 */
enum ServiceType: string
{
    case GUARANTEED_RESERVATION = 'guaranteed_reservation';

    case OTHER = 'other';

    case TIMESHARE = 'timeshare';
}

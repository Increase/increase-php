<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails;

/**
 * The type of this request (e.g., an initial authorization or an incremental authorization).
 */
enum Category: string
{
    case INITIAL_AUTHORIZATION = 'initial_authorization';

    case INCREMENTAL_AUTHORIZATION = 'incremental_authorization';
}

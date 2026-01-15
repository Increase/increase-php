<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication;

/**
 * The status of the card authentication.
 */
enum Status: string
{
    case DENIED = 'denied';

    case AUTHENTICATED_WITH_CHALLENGE = 'authenticated_with_challenge';

    case AUTHENTICATED_WITHOUT_CHALLENGE = 'authenticated_without_challenge';

    case AWAITING_CHALLENGE = 'awaiting_challenge';

    case VALIDATING_CHALLENGE = 'validating_challenge';

    case CANCELED = 'canceled';

    case TIMED_OUT_AWAITING_CHALLENGE = 'timed_out_awaiting_challenge';

    case ERRORED = 'errored';

    case EXCEEDED_ATTEMPT_THRESHOLD = 'exceeded_attempt_threshold';
}

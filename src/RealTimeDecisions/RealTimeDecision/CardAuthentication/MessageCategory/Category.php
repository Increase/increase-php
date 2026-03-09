<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory;

/**
 * The category of the card authentication attempt.
 */
enum Category: string
{
    case PAYMENT_AUTHENTICATION = 'payment_authentication';

    case NON_PAYMENT_AUTHENTICATION = 'non_payment_authentication';
}

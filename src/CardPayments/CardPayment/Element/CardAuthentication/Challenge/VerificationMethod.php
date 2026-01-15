<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge;

/**
 * The method used to verify the Card Authentication Challenge.
 */
enum VerificationMethod: string
{
    case TEXT_MESSAGE = 'text_message';

    case EMAIL = 'email';

    case NONE_AVAILABLE = 'none_available';
}

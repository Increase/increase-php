<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * The route of the capability.
 */
enum Route: string
{
    case VISA = 'visa';

    case MASTERCARD = 'mastercard';
}

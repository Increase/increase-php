<?php

declare(strict_types=1);

namespace Increase\CardTokens\CardTokenCapabilities\Route1;

/**
 * The card network route the capabilities apply to.
 */
enum Route: string
{
    case VISA = 'visa';

    case MASTERCARD = 'mastercard';
}

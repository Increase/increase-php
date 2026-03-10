<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens\CardTokenCreateParams\Outcome;

/**
 * Whether card push transfers or validations will be approved or declined.
 */
enum Result: string
{
    case APPROVE = 'approve';

    case DECLINE = 'decline';
}

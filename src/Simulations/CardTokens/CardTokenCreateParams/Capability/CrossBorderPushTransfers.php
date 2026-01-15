<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * The cross-border push transfers capability.
 */
enum CrossBorderPushTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}

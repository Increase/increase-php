<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * The domestic push transfers capability.
 */
enum DomesticPushTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}

<?php

declare(strict_types=1);

namespace Increase\CardTokens\CardTokenCapabilities\Route1;

/**
 * Whether you can push funds to the card using cross-border Card Push Transfers.
 */
enum CrossBorderPushTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}

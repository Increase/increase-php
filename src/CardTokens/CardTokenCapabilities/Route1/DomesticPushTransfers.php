<?php

declare(strict_types=1);

namespace Increase\CardTokens\CardTokenCapabilities\Route1;

/**
 * Whether you can push funds to the card using domestic Card Push Transfers.
 */
enum DomesticPushTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}

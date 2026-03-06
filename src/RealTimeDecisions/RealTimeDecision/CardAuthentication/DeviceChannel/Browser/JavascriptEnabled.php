<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel\Browser;

/**
 * Whether JavaScript is enabled in the cardholder's browser.
 */
enum JavascriptEnabled: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';
}

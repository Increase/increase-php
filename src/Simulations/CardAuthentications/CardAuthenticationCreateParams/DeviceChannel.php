<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams;

/**
 * The device channel of the card authentication attempt.
 */
enum DeviceChannel: string
{
    case APP = 'app';

    case BROWSER = 'browser';

    case THREE_DS_REQUESTOR_INITIATED = 'three_ds_requestor_initiated';
}

<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel;

/**
 * The category of the device channel.
 */
enum Category: string
{
    case APP = 'app';

    case BROWSER = 'browser';

    case THREE_DS_REQUESTOR_INITIATED = 'three_ds_requestor_initiated';
}

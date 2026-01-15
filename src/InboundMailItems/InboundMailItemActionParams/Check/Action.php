<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItemActionParams\Check;

/**
 * The action to perform on the Inbound Mail Item.
 */
enum Action: string
{
    case DEPOSIT = 'deposit';

    case IGNORE = 'ignore';
}

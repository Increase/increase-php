<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer;

/**
 * The card network route used for the transfer.
 */
enum Route: string
{
    case VISA = 'visa';

    case MASTERCARD = 'mastercard';
}

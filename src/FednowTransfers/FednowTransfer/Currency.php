<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For FedNow transfers this is always equal to `USD`.
 */
enum Currency: string
{
    case USD = 'USD';
}

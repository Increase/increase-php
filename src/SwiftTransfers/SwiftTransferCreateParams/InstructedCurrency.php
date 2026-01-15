<?php

declare(strict_types=1);

namespace Increase\SwiftTransfers\SwiftTransferCreateParams;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code of the instructed amount.
 */
enum InstructedCurrency: string
{
    case USD = 'USD';
}

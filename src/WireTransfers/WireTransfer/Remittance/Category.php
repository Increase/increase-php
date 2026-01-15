<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer\Remittance;

/**
 * The type of remittance information being passed.
 */
enum Category: string
{
    case UNSTRUCTURED = 'unstructured';

    case TAX = 'tax';
}

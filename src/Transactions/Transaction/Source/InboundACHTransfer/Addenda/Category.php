<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\InboundACHTransfer\Addenda;

/**
 * The type of addendum.
 */
enum Category: string
{
    case FREEFORM = 'freeform';
}

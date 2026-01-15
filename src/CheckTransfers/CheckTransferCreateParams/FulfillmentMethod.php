<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams;

/**
 * Whether Increase will print and mail the check or if you will do it yourself.
 */
enum FulfillmentMethod: string
{
    case PHYSICAL_CHECK = 'physical_check';

    case THIRD_PARTY = 'third_party';
}

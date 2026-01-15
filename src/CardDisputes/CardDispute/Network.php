<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

/**
 * The network that the Card Dispute is associated with.
 */
enum Network: string
{
    case VISA = 'visa';

    case PULSE = 'pulse';
}

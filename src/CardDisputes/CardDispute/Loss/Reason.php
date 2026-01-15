<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Loss;

/**
 * The reason the Card Dispute was lost.
 */
enum Reason: string
{
    case USER_WITHDRAWN = 'user_withdrawn';

    case LOSS = 'loss';
}

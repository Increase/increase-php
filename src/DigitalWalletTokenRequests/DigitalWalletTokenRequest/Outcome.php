<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

/**
 * The outcome of the tokenization request.
 */
enum Outcome: string
{
    case PROVISIONED = 'provisioned';

    case DECLINED = 'declined';
}

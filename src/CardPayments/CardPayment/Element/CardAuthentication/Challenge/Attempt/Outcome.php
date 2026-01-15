<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge\Attempt;

/**
 * The outcome of the Card Authentication Challenge Attempt.
 */
enum Outcome: string
{
    case SUCCESSFUL = 'successful';

    case FAILED = 'failed';
}

<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams;

/**
 * Simulate the outcome of [payee name checking](https://increase.com/documentation/positive-pay#payee-name-mismatches). Defaults to `not_evaluated`.
 */
enum PayeeNameAnalysis: string
{
    case NAME_MATCHES = 'name_matches';

    case DOES_NOT_MATCH = 'does_not_match';

    case NOT_EVALUATED = 'not_evaluated';
}

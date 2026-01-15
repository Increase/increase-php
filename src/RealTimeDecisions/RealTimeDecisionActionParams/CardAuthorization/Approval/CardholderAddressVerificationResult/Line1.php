<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval\CardholderAddressVerificationResult;

/**
 * Your decision on the address line of the provided address.
 */
enum Line1: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';
}

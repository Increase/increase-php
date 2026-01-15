<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval\CardholderAddressVerificationResult;

/**
 * Your decision on the postal code of the provided address.
 */
enum PostalCode: string
{
    case MATCH = 'match';

    case NO_MATCH = 'no_match';
}

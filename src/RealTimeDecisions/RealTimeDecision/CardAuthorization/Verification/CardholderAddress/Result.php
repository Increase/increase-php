<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Verification\CardholderAddress;

/**
 * The address verification result returned to the card network.
 */
enum Result: string
{
    case NOT_CHECKED = 'not_checked';

    case POSTAL_CODE_MATCH_ADDRESS_NO_MATCH = 'postal_code_match_address_no_match';

    case POSTAL_CODE_NO_MATCH_ADDRESS_MATCH = 'postal_code_no_match_address_match';

    case MATCH = 'match';

    case NO_MATCH = 'no_match';

    case POSTAL_CODE_MATCH_ADDRESS_NOT_CHECKED = 'postal_code_match_address_not_checked';
}

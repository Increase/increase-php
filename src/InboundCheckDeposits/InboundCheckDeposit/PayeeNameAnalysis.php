<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits\InboundCheckDeposit;

/**
 * Whether the details on the check match the recipient name of the check transfer. This is an optional feature, contact sales to enable.
 */
enum PayeeNameAnalysis: string
{
    case NAME_MATCHES = 'name_matches';

    case DOES_NOT_MATCH = 'does_not_match';

    case NOT_EVALUATED = 'not_evaluated';
}

<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda;

/**
 * A description of how the foreign exchange rate was calculated.
 */
enum ForeignExchangeIndicator: string
{
    case FIXED_TO_VARIABLE = 'fixed_to_variable';

    case VARIABLE_TO_FIXED = 'variable_to_fixed';

    case FIXED_TO_FIXED = 'fixed_to_fixed';
}

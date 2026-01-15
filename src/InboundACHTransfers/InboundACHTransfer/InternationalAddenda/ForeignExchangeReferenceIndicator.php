<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda;

/**
 * An instruction of how to interpret the `foreign_exchange_reference` field for this Transaction.
 */
enum ForeignExchangeReferenceIndicator: string
{
    case FOREIGN_EXCHANGE_RATE = 'foreign_exchange_rate';

    case FOREIGN_EXCHANGE_REFERENCE_NUMBER = 'foreign_exchange_reference_number';

    case BLANK = 'blank';
}

<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices;

/**
 * Non-fiat currency or non-fungible token related and not matching description.
 */
enum NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription: string
{
    case NOT_RELATED = 'not_related';

    case RELATED = 'related';
}

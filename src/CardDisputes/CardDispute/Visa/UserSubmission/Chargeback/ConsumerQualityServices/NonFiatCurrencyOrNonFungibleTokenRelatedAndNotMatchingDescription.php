<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices;

/**
 * Non-fiat currency or non-fungible token related and not matching description.
 */
enum NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription: string
{
    case NOT_RELATED = 'not_related';

    case RELATED = 'related';
}

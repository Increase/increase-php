<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Non-fiat currency or non-fungible token as described details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_as_described`.
 *
 * @phpstan-type NonFiatCurrencyOrNonFungibleTokenAsDescribedShape = array<string,mixed>
 */
final class NonFiatCurrencyOrNonFungibleTokenAsDescribed implements BaseModel
{
    /** @use SdkModel<NonFiatCurrencyOrNonFungibleTokenAsDescribedShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}

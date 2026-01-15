<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Merchant Pre-Arbitration Decline Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_decline_submitted`. Contains the details specific to a merchant prearbitration decline submitted Visa Card Dispute Network Event, which represents that the user has declined the merchant's request for a prearbitration request decision in their favor.
 *
 * @phpstan-type MerchantPrearbitrationDeclineSubmittedShape = array<string,mixed>
 */
final class MerchantPrearbitrationDeclineSubmitted implements BaseModel
{
    /** @use SdkModel<MerchantPrearbitrationDeclineSubmittedShape> */
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

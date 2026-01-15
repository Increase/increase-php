<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Merchant Pre-Arbitration Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_timed_out`. Contains the details specific to a merchant prearbitration timed out Visa Card Dispute Network Event, which represents that the user has timed out responding to the merchant's prearbitration request.
 *
 * @phpstan-type MerchantPrearbitrationTimedOutShape = array<string,mixed>
 */
final class MerchantPrearbitrationTimedOut implements BaseModel
{
    /** @use SdkModel<MerchantPrearbitrationTimedOutShape> */
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

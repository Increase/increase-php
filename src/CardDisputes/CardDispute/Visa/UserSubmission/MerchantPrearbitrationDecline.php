<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Visa Card Dispute Merchant Pre-Arbitration Decline User Submission object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_decline`. Contains the details specific to a merchant prearbitration decline Visa Card Dispute User Submission.
 *
 * @phpstan-type MerchantPrearbitrationDeclineShape = array{reason: string}
 */
final class MerchantPrearbitrationDecline implements BaseModel
{
    /** @use SdkModel<MerchantPrearbitrationDeclineShape> */
    use SdkModel;

    /**
     * The reason the user declined the merchant's request for pre-arbitration in their favor.
     */
    #[Required]
    public string $reason;

    /**
     * `new MerchantPrearbitrationDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MerchantPrearbitrationDecline::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MerchantPrearbitrationDecline)->withReason(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $reason): self
    {
        $self = new self;

        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason the user declined the merchant's request for pre-arbitration in their favor.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

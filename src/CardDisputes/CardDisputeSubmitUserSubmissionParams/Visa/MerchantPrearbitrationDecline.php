<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The merchant pre-arbitration decline details for the user submission. Required if and only if `category` is `merchant_prearbitration_decline`.
 *
 * @phpstan-type MerchantPrearbitrationDeclineShape = array{reason: string}
 */
final class MerchantPrearbitrationDecline implements BaseModel
{
    /** @use SdkModel<MerchantPrearbitrationDeclineShape> */
    use SdkModel;

    /**
     * The reason for declining the merchant's pre-arbitration request.
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
     * The reason for declining the merchant's pre-arbitration request.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

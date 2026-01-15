<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchant cancellation. Required if and only if `cancellation_outcome` is `merchant_cancellation`.
 *
 * @phpstan-type MerchantCancellationShape = array{canceledAt: string}
 */
final class MerchantCancellation implements BaseModel
{
    /** @use SdkModel<MerchantCancellationShape> */
    use SdkModel;

    /**
     * Canceled at.
     */
    #[Required('canceled_at')]
    public string $canceledAt;

    /**
     * `new MerchantCancellation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MerchantCancellation::with(canceledAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MerchantCancellation)->withCanceledAt(...)
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
    public static function with(string $canceledAt): self
    {
        $self = new self;

        $self['canceledAt'] = $canceledAt;

        return $self;
    }

    /**
     * Canceled at.
     */
    public function withCanceledAt(string $canceledAt): self
    {
        $self = clone $this;
        $self['canceledAt'] = $canceledAt;

        return $self;
    }
}

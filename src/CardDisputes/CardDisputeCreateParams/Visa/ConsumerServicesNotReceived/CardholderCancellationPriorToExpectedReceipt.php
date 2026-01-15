<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotReceived;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Cardholder cancellation prior to expected receipt. Required if and only if `cancellation_outcome` is `cardholder_cancellation_prior_to_expected_receipt`.
 *
 * @phpstan-type CardholderCancellationPriorToExpectedReceiptShape = array{
 *   canceledAt: string, reason?: string|null
 * }
 */
final class CardholderCancellationPriorToExpectedReceipt implements BaseModel
{
    /** @use SdkModel<CardholderCancellationPriorToExpectedReceiptShape> */
    use SdkModel;

    /**
     * Canceled at.
     */
    #[Required('canceled_at')]
    public string $canceledAt;

    /**
     * Reason.
     */
    #[Optional]
    public ?string $reason;

    /**
     * `new CardholderCancellationPriorToExpectedReceipt()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderCancellationPriorToExpectedReceipt::with(canceledAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderCancellationPriorToExpectedReceipt)->withCanceledAt(...)
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
    public static function with(string $canceledAt, ?string $reason = null): self
    {
        $self = new self;

        $self['canceledAt'] = $canceledAt;

        null !== $reason && $self['reason'] = $reason;

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

    /**
     * Reason.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

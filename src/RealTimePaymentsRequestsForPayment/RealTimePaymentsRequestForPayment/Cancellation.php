<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Cancellation\Reason;

/**
 * If a cancellation has been requested, this will contain supplemental details. The request for payment moves to `canceled` once the recipient bank acknowledges the cancellation.
 *
 * @phpstan-type CancellationShape = array{
 *   additionalInformation: string|null,
 *   canceledAt: \DateTimeInterface,
 *   reason: Reason|value-of<Reason>,
 * }
 */
final class Cancellation implements BaseModel
{
    /** @use SdkModel<CancellationShape> */
    use SdkModel;

    /**
     * Additional information about the cancellation, sent on to the recipient bank.
     */
    #[Required('additional_information')]
    public ?string $additionalInformation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the cancellation was requested.
     */
    #[Required('canceled_at')]
    public \DateTimeInterface $canceledAt;

    /**
     * The reason the request for payment was canceled.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new Cancellation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cancellation::with(additionalInformation: ..., canceledAt: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cancellation)
     *   ->withAdditionalInformation(...)
     *   ->withCanceledAt(...)
     *   ->withReason(...)
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
     *
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(
        ?string $additionalInformation,
        \DateTimeInterface $canceledAt,
        Reason|string $reason,
    ): self {
        $self = new self;

        $self['additionalInformation'] = $additionalInformation;
        $self['canceledAt'] = $canceledAt;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Additional information about the cancellation, sent on to the recipient bank.
     */
    public function withAdditionalInformation(
        ?string $additionalInformation
    ): self {
        $self = clone $this;
        $self['additionalInformation'] = $additionalInformation;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the cancellation was requested.
     */
    public function withCanceledAt(\DateTimeInterface $canceledAt): self
    {
        $self = clone $this;
        $self['canceledAt'] = $canceledAt;

        return $self;
    }

    /**
     * The reason the request for payment was canceled.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCancelParams\Reason;

/**
 * Cancels a Real-Time Payments Request for Payment that is still awaiting payment.
 *
 * @see Increase\Services\RealTimePaymentsRequestsForPaymentService::cancel()
 *
 * @phpstan-type RealTimePaymentsRequestsForPaymentCancelParamsShape = array{
 *   additionalInformation?: string|null, reason?: null|Reason|value-of<Reason>
 * }
 */
final class RealTimePaymentsRequestsForPaymentCancelParams implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsRequestsForPaymentCancelParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Additional information about the cancellation to pass on to the recipient bank.
     */
    #[Optional('additional_information')]
    public ?string $additionalInformation;

    /**
     * The reason the request for payment is being canceled. Defaults to `requested_by_customer`.
     *
     * @var value-of<Reason>|null $reason
     */
    #[Optional(enum: Reason::class)]
    public ?string $reason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Reason|value-of<Reason>|null $reason
     */
    public static function with(
        ?string $additionalInformation = null,
        Reason|string|null $reason = null
    ): self {
        $self = new self;

        null !== $additionalInformation && $self['additionalInformation'] = $additionalInformation;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * Additional information about the cancellation to pass on to the recipient bank.
     */
    public function withAdditionalInformation(
        string $additionalInformation
    ): self {
        $self = clone $this;
        $self['additionalInformation'] = $additionalInformation;

        return $self;
    }

    /**
     * The reason the request for payment is being canceled. Defaults to `requested_by_customer`.
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

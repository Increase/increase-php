<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerQualityServices;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerQualityServices\CardholderCancellation\AcceptedByMerchant;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Cardholder cancellation.
 *
 * @phpstan-type CardholderCancellationShape = array{
 *   acceptedByMerchant: AcceptedByMerchant|value-of<AcceptedByMerchant>,
 *   canceledAt: string,
 *   reason: string,
 * }
 */
final class CardholderCancellation implements BaseModel
{
    /** @use SdkModel<CardholderCancellationShape> */
    use SdkModel;

    /**
     * Accepted by merchant.
     *
     * @var value-of<AcceptedByMerchant> $acceptedByMerchant
     */
    #[Required('accepted_by_merchant', enum: AcceptedByMerchant::class)]
    public string $acceptedByMerchant;

    /**
     * Canceled at.
     */
    #[Required('canceled_at')]
    public string $canceledAt;

    /**
     * Reason.
     */
    #[Required]
    public string $reason;

    /**
     * `new CardholderCancellation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderCancellation::with(
     *   acceptedByMerchant: ..., canceledAt: ..., reason: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderCancellation)
     *   ->withAcceptedByMerchant(...)
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
     * @param AcceptedByMerchant|value-of<AcceptedByMerchant> $acceptedByMerchant
     */
    public static function with(
        AcceptedByMerchant|string $acceptedByMerchant,
        string $canceledAt,
        string $reason,
    ): self {
        $self = new self;

        $self['acceptedByMerchant'] = $acceptedByMerchant;
        $self['canceledAt'] = $canceledAt;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Accepted by merchant.
     *
     * @param AcceptedByMerchant|value-of<AcceptedByMerchant> $acceptedByMerchant
     */
    public function withAcceptedByMerchant(
        AcceptedByMerchant|string $acceptedByMerchant
    ): self {
        $self = clone $this;
        $self['acceptedByMerchant'] = $acceptedByMerchant;

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

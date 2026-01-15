<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation\CanceledPriorToShipDate;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation\CancellationPolicyProvided;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Cardholder cancellation.
 *
 * @phpstan-type CardholderCancellationShape = array{
 *   canceledAt: string,
 *   canceledPriorToShipDate: CanceledPriorToShipDate|value-of<CanceledPriorToShipDate>,
 *   cancellationPolicyProvided: CancellationPolicyProvided|value-of<CancellationPolicyProvided>,
 *   reason: string,
 * }
 */
final class CardholderCancellation implements BaseModel
{
    /** @use SdkModel<CardholderCancellationShape> */
    use SdkModel;

    /**
     * Canceled at.
     */
    #[Required('canceled_at')]
    public string $canceledAt;

    /**
     * Canceled prior to ship date.
     *
     * @var value-of<CanceledPriorToShipDate> $canceledPriorToShipDate
     */
    #[Required(
        'canceled_prior_to_ship_date',
        enum: CanceledPriorToShipDate::class
    )]
    public string $canceledPriorToShipDate;

    /**
     * Cancellation policy provided.
     *
     * @var value-of<CancellationPolicyProvided> $cancellationPolicyProvided
     */
    #[Required(
        'cancellation_policy_provided',
        enum: CancellationPolicyProvided::class
    )]
    public string $cancellationPolicyProvided;

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
     *   canceledAt: ...,
     *   canceledPriorToShipDate: ...,
     *   cancellationPolicyProvided: ...,
     *   reason: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderCancellation)
     *   ->withCanceledAt(...)
     *   ->withCanceledPriorToShipDate(...)
     *   ->withCancellationPolicyProvided(...)
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
     * @param CanceledPriorToShipDate|value-of<CanceledPriorToShipDate> $canceledPriorToShipDate
     * @param CancellationPolicyProvided|value-of<CancellationPolicyProvided> $cancellationPolicyProvided
     */
    public static function with(
        string $canceledAt,
        CanceledPriorToShipDate|string $canceledPriorToShipDate,
        CancellationPolicyProvided|string $cancellationPolicyProvided,
        string $reason,
    ): self {
        $self = new self;

        $self['canceledAt'] = $canceledAt;
        $self['canceledPriorToShipDate'] = $canceledPriorToShipDate;
        $self['cancellationPolicyProvided'] = $cancellationPolicyProvided;
        $self['reason'] = $reason;

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
     * Canceled prior to ship date.
     *
     * @param CanceledPriorToShipDate|value-of<CanceledPriorToShipDate> $canceledPriorToShipDate
     */
    public function withCanceledPriorToShipDate(
        CanceledPriorToShipDate|string $canceledPriorToShipDate
    ): self {
        $self = clone $this;
        $self['canceledPriorToShipDate'] = $canceledPriorToShipDate;

        return $self;
    }

    /**
     * Cancellation policy provided.
     *
     * @param CancellationPolicyProvided|value-of<CancellationPolicyProvided> $cancellationPolicyProvided
     */
    public function withCancellationPolicyProvided(
        CancellationPolicyProvided|string $cancellationPolicyProvided
    ): self {
        $self = clone $this;
        $self['cancellationPolicyProvided'] = $cancellationPolicyProvided;

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

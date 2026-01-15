<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Credit not processed. Required if and only if `category` is `consumer_credit_not_processed`.
 *
 * @phpstan-type ConsumerCreditNotProcessedShape = array{
 *   canceledOrReturnedAt?: string|null, creditExpectedAt?: string|null
 * }
 */
final class ConsumerCreditNotProcessed implements BaseModel
{
    /** @use SdkModel<ConsumerCreditNotProcessedShape> */
    use SdkModel;

    /**
     * Canceled or returned at.
     */
    #[Optional('canceled_or_returned_at')]
    public ?string $canceledOrReturnedAt;

    /**
     * Credit expected at.
     */
    #[Optional('credit_expected_at')]
    public ?string $creditExpectedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $canceledOrReturnedAt = null,
        ?string $creditExpectedAt = null
    ): self {
        $self = new self;

        null !== $canceledOrReturnedAt && $self['canceledOrReturnedAt'] = $canceledOrReturnedAt;
        null !== $creditExpectedAt && $self['creditExpectedAt'] = $creditExpectedAt;

        return $self;
    }

    /**
     * Canceled or returned at.
     */
    public function withCanceledOrReturnedAt(string $canceledOrReturnedAt): self
    {
        $self = clone $this;
        $self['canceledOrReturnedAt'] = $canceledOrReturnedAt;

        return $self;
    }

    /**
     * Credit expected at.
     */
    public function withCreditExpectedAt(string $creditExpectedAt): self
    {
        $self = clone $this;
        $self['creditExpectedAt'] = $creditExpectedAt;

        return $self;
    }
}

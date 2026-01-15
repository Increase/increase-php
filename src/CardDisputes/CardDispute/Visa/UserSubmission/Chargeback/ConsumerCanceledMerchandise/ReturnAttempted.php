<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\ReturnAttempted\AttemptReason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Return attempted. Present if and only if `return_outcome` is `return_attempted`.
 *
 * @phpstan-type ReturnAttemptedShape = array{
 *   attemptExplanation: string,
 *   attemptReason: AttemptReason|value-of<AttemptReason>,
 *   attemptedAt: string,
 *   merchandiseDisposition: string,
 * }
 */
final class ReturnAttempted implements BaseModel
{
    /** @use SdkModel<ReturnAttemptedShape> */
    use SdkModel;

    /**
     * Attempt explanation.
     */
    #[Required('attempt_explanation')]
    public string $attemptExplanation;

    /**
     * Attempt reason.
     *
     * @var value-of<AttemptReason> $attemptReason
     */
    #[Required('attempt_reason', enum: AttemptReason::class)]
    public string $attemptReason;

    /**
     * Attempted at.
     */
    #[Required('attempted_at')]
    public string $attemptedAt;

    /**
     * Merchandise disposition.
     */
    #[Required('merchandise_disposition')]
    public string $merchandiseDisposition;

    /**
     * `new ReturnAttempted()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReturnAttempted::with(
     *   attemptExplanation: ...,
     *   attemptReason: ...,
     *   attemptedAt: ...,
     *   merchandiseDisposition: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReturnAttempted)
     *   ->withAttemptExplanation(...)
     *   ->withAttemptReason(...)
     *   ->withAttemptedAt(...)
     *   ->withMerchandiseDisposition(...)
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
     * @param AttemptReason|value-of<AttemptReason> $attemptReason
     */
    public static function with(
        string $attemptExplanation,
        AttemptReason|string $attemptReason,
        string $attemptedAt,
        string $merchandiseDisposition,
    ): self {
        $self = new self;

        $self['attemptExplanation'] = $attemptExplanation;
        $self['attemptReason'] = $attemptReason;
        $self['attemptedAt'] = $attemptedAt;
        $self['merchandiseDisposition'] = $merchandiseDisposition;

        return $self;
    }

    /**
     * Attempt explanation.
     */
    public function withAttemptExplanation(string $attemptExplanation): self
    {
        $self = clone $this;
        $self['attemptExplanation'] = $attemptExplanation;

        return $self;
    }

    /**
     * Attempt reason.
     *
     * @param AttemptReason|value-of<AttemptReason> $attemptReason
     */
    public function withAttemptReason(AttemptReason|string $attemptReason): self
    {
        $self = clone $this;
        $self['attemptReason'] = $attemptReason;

        return $self;
    }

    /**
     * Attempted at.
     */
    public function withAttemptedAt(string $attemptedAt): self
    {
        $self = clone $this;
        $self['attemptedAt'] = $attemptedAt;

        return $self;
    }

    /**
     * Merchandise disposition.
     */
    public function withMerchandiseDisposition(
        string $merchandiseDisposition
    ): self {
        $self = clone $this;
        $self['merchandiseDisposition'] = $merchandiseDisposition;

        return $self;
    }
}

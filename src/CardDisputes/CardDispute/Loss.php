<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

use Increase\CardDisputes\CardDispute\Loss\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the Card Dispute's status is `lost`, this will contain details of the lost dispute.
 *
 * @phpstan-type LossShape = array{
 *   lostAt: \DateTimeInterface, reason: Reason|value-of<Reason>
 * }
 */
final class Loss implements BaseModel
{
    /** @use SdkModel<LossShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was lost.
     */
    #[Required('lost_at')]
    public \DateTimeInterface $lostAt;

    /**
     * The reason the Card Dispute was lost.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new Loss()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loss::with(lostAt: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loss)->withLostAt(...)->withReason(...)
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
        \DateTimeInterface $lostAt,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['lostAt'] = $lostAt;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was lost.
     */
    public function withLostAt(\DateTimeInterface $lostAt): self
    {
        $self = clone $this;
        $self['lostAt'] = $lostAt;

        return $self;
    }

    /**
     * The reason the Card Dispute was lost.
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

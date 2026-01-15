<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers\InboundWireTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundWireTransfers\InboundWireTransfer\Reversal\Reason;

/**
 * Information about the reversal of the inbound wire transfer if it has been reversed.
 *
 * @phpstan-type ReversalShape = array{
 *   reason: Reason|value-of<Reason>, reversedAt: \DateTimeInterface
 * }
 */
final class Reversal implements BaseModel
{
    /** @use SdkModel<ReversalShape> */
    use SdkModel;

    /**
     * The reason for the reversal.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was reversed.
     */
    #[Required('reversed_at')]
    public \DateTimeInterface $reversedAt;

    /**
     * `new Reversal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reversal::with(reason: ..., reversedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reversal)->withReason(...)->withReversedAt(...)
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
        Reason|string $reason,
        \DateTimeInterface $reversedAt
    ): self {
        $self = new self;

        $self['reason'] = $reason;
        $self['reversedAt'] = $reversedAt;

        return $self;
    }

    /**
     * The reason for the reversal.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was reversed.
     */
    public function withReversedAt(\DateTimeInterface $reversedAt): self
    {
        $self = clone $this;
        $self['reversedAt'] = $reversedAt;

        return $self;
    }
}

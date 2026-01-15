<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransfer\Decline\Reason;

/**
 * If your transfer is declined, this will contain details of the decline.
 *
 * @phpstan-type DeclineShape = array{
 *   declinedAt: \DateTimeInterface,
 *   declinedTransactionID: string,
 *   reason: Reason|value-of<Reason>,
 * }
 */
final class Decline implements BaseModel
{
    /** @use SdkModel<DeclineShape> */
    use SdkModel;

    /**
     * The time at which the transfer was declined.
     */
    #[Required('declined_at')]
    public \DateTimeInterface $declinedAt;

    /**
     * The id of the transaction for the declined transfer.
     */
    #[Required('declined_transaction_id')]
    public string $declinedTransactionID;

    /**
     * The reason for the transfer decline.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new Decline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Decline::with(declinedAt: ..., declinedTransactionID: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Decline)
     *   ->withDeclinedAt(...)
     *   ->withDeclinedTransactionID(...)
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
        \DateTimeInterface $declinedAt,
        string $declinedTransactionID,
        Reason|string $reason,
    ): self {
        $self = new self;

        $self['declinedAt'] = $declinedAt;
        $self['declinedTransactionID'] = $declinedTransactionID;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The time at which the transfer was declined.
     */
    public function withDeclinedAt(\DateTimeInterface $declinedAt): self
    {
        $self = clone $this;
        $self['declinedAt'] = $declinedAt;

        return $self;
    }

    /**
     * The id of the transaction for the declined transfer.
     */
    public function withDeclinedTransactionID(
        string $declinedTransactionID
    ): self {
        $self = clone $this;
        $self['declinedTransactionID'] = $declinedTransactionID;

        return $self;
    }

    /**
     * The reason for the transfer decline.
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

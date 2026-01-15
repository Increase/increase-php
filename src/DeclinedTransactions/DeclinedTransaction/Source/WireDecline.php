<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\WireDecline\Reason;

/**
 * A Wire Decline object. This field will be present in the JSON response if and only if `category` is equal to `wire_decline`.
 *
 * @phpstan-type WireDeclineShape = array{
 *   inboundWireTransferID: string, reason: Reason|value-of<Reason>
 * }
 */
final class WireDecline implements BaseModel
{
    /** @use SdkModel<WireDeclineShape> */
    use SdkModel;

    /**
     * The identifier of the Inbound Wire Transfer that was declined.
     */
    #[Required('inbound_wire_transfer_id')]
    public string $inboundWireTransferID;

    /**
     * Why the wire transfer was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new WireDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WireDecline::with(inboundWireTransferID: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WireDecline)->withInboundWireTransferID(...)->withReason(...)
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
        string $inboundWireTransferID,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['inboundWireTransferID'] = $inboundWireTransferID;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The identifier of the Inbound Wire Transfer that was declined.
     */
    public function withInboundWireTransferID(
        string $inboundWireTransferID
    ): self {
        $self = clone $this;
        $self['inboundWireTransferID'] = $inboundWireTransferID;

        return $self;
    }

    /**
     * Why the wire transfer was declined.
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

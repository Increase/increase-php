<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An Inbound Wire Transfer Reversal object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer_reversal`. An Inbound Wire Transfer Reversal is created when Increase has received a wire and the User requests that it be reversed.
 *
 * @phpstan-type InboundWireTransferReversalShape = array{
 *   inboundWireTransferID: string
 * }
 */
final class InboundWireTransferReversal implements BaseModel
{
    /** @use SdkModel<InboundWireTransferReversalShape> */
    use SdkModel;

    /**
     * The ID of the Inbound Wire Transfer that is being reversed.
     */
    #[Required('inbound_wire_transfer_id')]
    public string $inboundWireTransferID;

    /**
     * `new InboundWireTransferReversal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireTransferReversal::with(inboundWireTransferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireTransferReversal)->withInboundWireTransferID(...)
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
     */
    public static function with(string $inboundWireTransferID): self
    {
        $self = new self;

        $self['inboundWireTransferID'] = $inboundWireTransferID;

        return $self;
    }

    /**
     * The ID of the Inbound Wire Transfer that is being reversed.
     */
    public function withInboundWireTransferID(
        string $inboundWireTransferID
    ): self {
        $self = clone $this;
        $self['inboundWireTransferID'] = $inboundWireTransferID;

        return $self;
    }
}

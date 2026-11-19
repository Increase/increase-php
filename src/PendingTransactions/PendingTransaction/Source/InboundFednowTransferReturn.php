<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\InboundFednowTransferReturn\Reason;

/**
 * An Inbound FedNow Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_return`. An Inbound FedNow Transfer Return is created when Increase has received a FedNow transfer and the User requests that it be returned.
 *
 * @phpstan-type InboundFednowTransferReturnShape = array{
 *   inboundFednowTransferID: string, reason: Reason|value-of<Reason>
 * }
 */
final class InboundFednowTransferReturn implements BaseModel
{
    /** @use SdkModel<InboundFednowTransferReturnShape> */
    use SdkModel;

    /**
     * The identifier of the Inbound FedNow Transfer that is being returned.
     */
    #[Required('inbound_fednow_transfer_id')]
    public string $inboundFednowTransferID;

    /**
     * The reason for the return.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new InboundFednowTransferReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundFednowTransferReturn::with(inboundFednowTransferID: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundFednowTransferReturn)
     *   ->withInboundFednowTransferID(...)
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
        string $inboundFednowTransferID,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['inboundFednowTransferID'] = $inboundFednowTransferID;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The identifier of the Inbound FedNow Transfer that is being returned.
     */
    public function withInboundFednowTransferID(
        string $inboundFednowTransferID
    ): self {
        $self = clone $this;
        $self['inboundFednowTransferID'] = $inboundFednowTransferID;

        return $self;
    }

    /**
     * The reason for the return.
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

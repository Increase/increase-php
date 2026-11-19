<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\InboundFednowTransferReturnAcknowledgement\Reason;

/**
 * An Inbound FedNow Transfer Return Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_return_acknowledgement`. An Inbound FedNow Transfer Return Acknowledgement is created when a return of an Inbound FedNow Transfer has been accepted and settled by the FedNow Service.
 *
 * @phpstan-type InboundFednowTransferReturnAcknowledgementShape = array{
 *   inboundFednowTransferID: string, reason: Reason|value-of<Reason>
 * }
 */
final class InboundFednowTransferReturnAcknowledgement implements BaseModel
{
    /** @use SdkModel<InboundFednowTransferReturnAcknowledgementShape> */
    use SdkModel;

    /**
     * The identifier of the Inbound FedNow Transfer that was returned.
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
     * `new InboundFednowTransferReturnAcknowledgement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundFednowTransferReturnAcknowledgement::with(
     *   inboundFednowTransferID: ..., reason: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundFednowTransferReturnAcknowledgement)
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
     * The identifier of the Inbound FedNow Transfer that was returned.
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

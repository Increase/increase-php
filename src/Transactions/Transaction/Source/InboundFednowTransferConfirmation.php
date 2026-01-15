<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An Inbound FedNow Transfer Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_confirmation`. An Inbound FedNow Transfer Confirmation is created when a FedNow transfer is initiated at another bank and received by Increase.
 *
 * @phpstan-type InboundFednowTransferConfirmationShape = array{transferID: string}
 */
final class InboundFednowTransferConfirmation implements BaseModel
{
    /** @use SdkModel<InboundFednowTransferConfirmationShape> */
    use SdkModel;

    /**
     * The identifier of the FedNow Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new InboundFednowTransferConfirmation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundFednowTransferConfirmation::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundFednowTransferConfirmation)->withTransferID(...)
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
    public static function with(string $transferID): self
    {
        $self = new self;

        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The identifier of the FedNow Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

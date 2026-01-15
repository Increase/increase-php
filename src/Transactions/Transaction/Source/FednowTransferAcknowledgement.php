<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A FedNow Transfer Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_acknowledgement`. A FedNow Transfer Acknowledgement is created when a FedNow Transfer sent from Increase is acknowledged by the receiving bank.
 *
 * @phpstan-type FednowTransferAcknowledgementShape = array{transferID: string}
 */
final class FednowTransferAcknowledgement implements BaseModel
{
    /** @use SdkModel<FednowTransferAcknowledgementShape> */
    use SdkModel;

    /**
     * The identifier of the FedNow Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new FednowTransferAcknowledgement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FednowTransferAcknowledgement::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FednowTransferAcknowledgement)->withTransferID(...)
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

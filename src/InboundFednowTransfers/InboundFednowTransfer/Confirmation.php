<?php

declare(strict_types=1);

namespace Increase\InboundFednowTransfers\InboundFednowTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your transfer is confirmed, this will contain details of the confirmation.
 *
 * @phpstan-type ConfirmationShape = array{transferID: string}
 */
final class Confirmation implements BaseModel
{
    /** @use SdkModel<ConfirmationShape> */
    use SdkModel;

    /**
     * The identifier of the FedNow Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new Confirmation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Confirmation::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Confirmation)->withTransferID(...)
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

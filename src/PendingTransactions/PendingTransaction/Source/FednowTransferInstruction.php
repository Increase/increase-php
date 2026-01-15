<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A FedNow Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_instruction`.
 *
 * @phpstan-type FednowTransferInstructionShape = array{transferID: string}
 */
final class FednowTransferInstruction implements BaseModel
{
    /** @use SdkModel<FednowTransferInstructionShape> */
    use SdkModel;

    /**
     * The identifier of the FedNow Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new FednowTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FednowTransferInstruction::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FednowTransferInstruction)->withTransferID(...)
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
     * The identifier of the FedNow Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

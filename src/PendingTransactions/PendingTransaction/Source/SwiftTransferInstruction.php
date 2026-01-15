<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Swift Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_instruction`.
 *
 * @phpstan-type SwiftTransferInstructionShape = array{transferID: string}
 */
final class SwiftTransferInstruction implements BaseModel
{
    /** @use SdkModel<SwiftTransferInstructionShape> */
    use SdkModel;

    /**
     * The identifier of the Swift Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new SwiftTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SwiftTransferInstruction::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SwiftTransferInstruction)->withTransferID(...)
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
     * The identifier of the Swift Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An ACH Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_instruction`.
 *
 * @phpstan-type ACHTransferInstructionShape = array{
 *   amount: int, transferID: string
 * }
 */
final class ACHTransferInstruction implements BaseModel
{
    /** @use SdkModel<ACHTransferInstructionShape> */
    use SdkModel;

    /**
     * The pending amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the ACH Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new ACHTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHTransferInstruction::with(amount: ..., transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHTransferInstruction)->withAmount(...)->withTransferID(...)
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
    public static function with(int $amount, string $transferID): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The pending amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the ACH Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

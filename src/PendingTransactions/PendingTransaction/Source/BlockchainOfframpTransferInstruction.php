<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Blockchain Off-Ramp Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_offramp_transfer_instruction`.
 *
 * @phpstan-type BlockchainOfframpTransferInstructionShape = array{
 *   sourceBlockchainAddressID: string, transferID: string
 * }
 */
final class BlockchainOfframpTransferInstruction implements BaseModel
{
    /** @use SdkModel<BlockchainOfframpTransferInstructionShape> */
    use SdkModel;

    /**
     * The identifier of the Blockchain Address the funds were received at.
     */
    #[Required('source_blockchain_address_id')]
    public string $sourceBlockchainAddressID;

    /**
     * The identifier of the Blockchain Off-Ramp Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new BlockchainOfframpTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockchainOfframpTransferInstruction::with(
     *   sourceBlockchainAddressID: ..., transferID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockchainOfframpTransferInstruction)
     *   ->withSourceBlockchainAddressID(...)
     *   ->withTransferID(...)
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
    public static function with(
        string $sourceBlockchainAddressID,
        string $transferID
    ): self {
        $self = new self;

        $self['sourceBlockchainAddressID'] = $sourceBlockchainAddressID;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The identifier of the Blockchain Address the funds were received at.
     */
    public function withSourceBlockchainAddressID(
        string $sourceBlockchainAddressID
    ): self {
        $self = clone $this;
        $self['sourceBlockchainAddressID'] = $sourceBlockchainAddressID;

        return $self;
    }

    /**
     * The identifier of the Blockchain Off-Ramp Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

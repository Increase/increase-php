<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Blockchain On-Ramp Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_onramp_transfer_instruction`.
 *
 * @phpstan-type BlockchainOnrampTransferInstructionShape = array{
 *   amount: int, destinationBlockchainAddress: string, transferID: string
 * }
 */
final class BlockchainOnrampTransferInstruction implements BaseModel
{
    /** @use SdkModel<BlockchainOnrampTransferInstructionShape> */
    use SdkModel;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The blockchain address the funds are being sent to.
     */
    #[Required('destination_blockchain_address')]
    public string $destinationBlockchainAddress;

    /**
     * The identifier of the Blockchain On-Ramp Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new BlockchainOnrampTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockchainOnrampTransferInstruction::with(
     *   amount: ..., destinationBlockchainAddress: ..., transferID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockchainOnrampTransferInstruction)
     *   ->withAmount(...)
     *   ->withDestinationBlockchainAddress(...)
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
        int $amount,
        string $destinationBlockchainAddress,
        string $transferID
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['destinationBlockchainAddress'] = $destinationBlockchainAddress;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The transfer amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The blockchain address the funds are being sent to.
     */
    public function withDestinationBlockchainAddress(
        string $destinationBlockchainAddress
    ): self {
        $self = clone $this;
        $self['destinationBlockchainAddress'] = $destinationBlockchainAddress;

        return $self;
    }

    /**
     * The identifier of the Blockchain On-Ramp Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

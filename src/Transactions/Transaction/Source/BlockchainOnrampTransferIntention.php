<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Blockchain On-Ramp Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_onramp_transfer_intention`.
 *
 * @phpstan-type BlockchainOnrampTransferIntentionShape = array{
 *   destinationBlockchainAddress: string, transferID: string
 * }
 */
final class BlockchainOnrampTransferIntention implements BaseModel
{
    /** @use SdkModel<BlockchainOnrampTransferIntentionShape> */
    use SdkModel;

    /**
     * The blockchain address the funds were sent to.
     */
    #[Required('destination_blockchain_address')]
    public string $destinationBlockchainAddress;

    /**
     * The identifier of the Blockchain On-Ramp Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new BlockchainOnrampTransferIntention()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockchainOnrampTransferIntention::with(
     *   destinationBlockchainAddress: ..., transferID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockchainOnrampTransferIntention)
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
        string $destinationBlockchainAddress,
        string $transferID
    ): self {
        $self = new self;

        $self['destinationBlockchainAddress'] = $destinationBlockchainAddress;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The blockchain address the funds were sent to.
     */
    public function withDestinationBlockchainAddress(
        string $destinationBlockchainAddress
    ): self {
        $self = clone $this;
        $self['destinationBlockchainAddress'] = $destinationBlockchainAddress;

        return $self;
    }

    /**
     * The identifier of the Blockchain On-Ramp Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

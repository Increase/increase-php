<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Non-fiat currency or non-fungible token received details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_received`.
 *
 * @phpstan-type NonFiatCurrencyOrNonFungibleTokenReceivedShape = array{
 *   blockchainTransactionHash: string,
 *   destinationWalletAddress: string,
 *   priorApprovedTransactions: string|null,
 * }
 */
final class NonFiatCurrencyOrNonFungibleTokenReceived implements BaseModel
{
    /** @use SdkModel<NonFiatCurrencyOrNonFungibleTokenReceivedShape> */
    use SdkModel;

    /**
     * Blockchain transaction hash.
     */
    #[Required('blockchain_transaction_hash')]
    public string $blockchainTransactionHash;

    /**
     * Destination wallet address.
     */
    #[Required('destination_wallet_address')]
    public string $destinationWalletAddress;

    /**
     * Prior approved transactions.
     */
    #[Required('prior_approved_transactions')]
    public ?string $priorApprovedTransactions;

    /**
     * `new NonFiatCurrencyOrNonFungibleTokenReceived()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NonFiatCurrencyOrNonFungibleTokenReceived::with(
     *   blockchainTransactionHash: ...,
     *   destinationWalletAddress: ...,
     *   priorApprovedTransactions: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NonFiatCurrencyOrNonFungibleTokenReceived)
     *   ->withBlockchainTransactionHash(...)
     *   ->withDestinationWalletAddress(...)
     *   ->withPriorApprovedTransactions(...)
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
        string $blockchainTransactionHash,
        string $destinationWalletAddress,
        ?string $priorApprovedTransactions,
    ): self {
        $self = new self;

        $self['blockchainTransactionHash'] = $blockchainTransactionHash;
        $self['destinationWalletAddress'] = $destinationWalletAddress;
        $self['priorApprovedTransactions'] = $priorApprovedTransactions;

        return $self;
    }

    /**
     * Blockchain transaction hash.
     */
    public function withBlockchainTransactionHash(
        string $blockchainTransactionHash
    ): self {
        $self = clone $this;
        $self['blockchainTransactionHash'] = $blockchainTransactionHash;

        return $self;
    }

    /**
     * Destination wallet address.
     */
    public function withDestinationWalletAddress(
        string $destinationWalletAddress
    ): self {
        $self = clone $this;
        $self['destinationWalletAddress'] = $destinationWalletAddress;

        return $self;
    }

    /**
     * Prior approved transactions.
     */
    public function withPriorApprovedTransactions(
        ?string $priorApprovedTransactions
    ): self {
        $self = clone $this;
        $self['priorApprovedTransactions'] = $priorApprovedTransactions;

        return $self;
    }
}

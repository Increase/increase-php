<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransfer\Status;
use Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransfer\Token;
use Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransfer\Type;

/**
 * A Blockchain Off-Ramp Transfer object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_offramp_transfer`. Blockchain Off-Ramp Transfers move funds from a Blockchain Address to an Account. They're automatically created when funds land in a Blockchain Address.
 *
 * @phpstan-type BlockchainOfframpTransferShape = array{
 *   id: string,
 *   token: Token|value-of<Token>,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   destinationAccountID: string,
 *   initiatingTransactionHash: string,
 *   sourceBlockchainAddressID: string,
 *   status: Status|value-of<Status>,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class BlockchainOfframpTransfer implements BaseModel
{
    /** @use SdkModel<BlockchainOfframpTransferShape> */
    use SdkModel;

    /**
     * The Blockchain Off-Ramp Transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The token that was received.
     *
     * @var value-of<Token> $token
     */
    #[Required(enum: Token::class)]
    public string $token;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The Account the funds were transferred into.
     */
    #[Required('destination_account_id')]
    public string $destinationAccountID;

    /**
     * The transaction hash of the blockchain transaction that initiated this transfer.
     */
    #[Required('initiating_transaction_hash')]
    public string $initiatingTransactionHash;

    /**
     * The Blockchain Address from which the transfer originated.
     */
    #[Required('source_blockchain_address_id')]
    public string $sourceBlockchainAddressID;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The Transaction crediting the Account once the transfer is settled.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `blockchain_offramp_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BlockchainOfframpTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockchainOfframpTransfer::with(
     *   id: ...,
     *   token: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   destinationAccountID: ...,
     *   initiatingTransactionHash: ...,
     *   sourceBlockchainAddressID: ...,
     *   status: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockchainOfframpTransfer)
     *   ->withID(...)
     *   ->withToken(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withDestinationAccountID(...)
     *   ->withInitiatingTransactionHash(...)
     *   ->withSourceBlockchainAddressID(...)
     *   ->withStatus(...)
     *   ->withTransactionID(...)
     *   ->withType(...)
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
     *
     * @param Token|value-of<Token> $token
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Token|string $token,
        int $amount,
        \DateTimeInterface $createdAt,
        string $destinationAccountID,
        string $initiatingTransactionHash,
        string $sourceBlockchainAddressID,
        Status|string $status,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['token'] = $token;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['destinationAccountID'] = $destinationAccountID;
        $self['initiatingTransactionHash'] = $initiatingTransactionHash;
        $self['sourceBlockchainAddressID'] = $sourceBlockchainAddressID;
        $self['status'] = $status;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Blockchain Off-Ramp Transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The token that was received.
     *
     * @param Token|value-of<Token> $token
     */
    public function withToken(Token|string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The Account the funds were transferred into.
     */
    public function withDestinationAccountID(string $destinationAccountID): self
    {
        $self = clone $this;
        $self['destinationAccountID'] = $destinationAccountID;

        return $self;
    }

    /**
     * The transaction hash of the blockchain transaction that initiated this transfer.
     */
    public function withInitiatingTransactionHash(
        string $initiatingTransactionHash
    ): self {
        $self = clone $this;
        $self['initiatingTransactionHash'] = $initiatingTransactionHash;

        return $self;
    }

    /**
     * The Blockchain Address from which the transfer originated.
     */
    public function withSourceBlockchainAddressID(
        string $sourceBlockchainAddressID
    ): self {
        $self = clone $this;
        $self['sourceBlockchainAddressID'] = $sourceBlockchainAddressID;

        return $self;
    }

    /**
     * The lifecycle status of the transfer.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The Transaction crediting the Account once the transfer is settled.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `blockchain_offramp_transfer`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

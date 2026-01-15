<?php

declare(strict_types=1);

namespace Increase\AccountTransfers;

use Increase\AccountTransfers\AccountTransfer\Approval;
use Increase\AccountTransfers\AccountTransfer\Cancellation;
use Increase\AccountTransfers\AccountTransfer\CreatedBy;
use Increase\AccountTransfers\AccountTransfer\Currency;
use Increase\AccountTransfers\AccountTransfer\Status;
use Increase\AccountTransfers\AccountTransfer\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Account transfers move funds between your own accounts at Increase (accounting systems often refer to these as Book Transfers). Account Transfers are free and synchronous. Upon creation they create two Transactions, one negative on the originating account and one positive on the destination account (unless the transfer requires approval, in which case the Transactions will be created when the transfer is approved).
 *
 * @phpstan-import-type ApprovalShape from \Increase\AccountTransfers\AccountTransfer\Approval
 * @phpstan-import-type CancellationShape from \Increase\AccountTransfers\AccountTransfer\Cancellation
 * @phpstan-import-type CreatedByShape from \Increase\AccountTransfers\AccountTransfer\CreatedBy
 *
 * @phpstan-type AccountTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   amount: int,
 *   approval: null|Approval|ApprovalShape,
 *   cancellation: null|Cancellation|CancellationShape,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   currency: Currency|value-of<Currency>,
 *   description: string,
 *   destinationAccountID: string,
 *   destinationTransactionID: string|null,
 *   idempotencyKey: string|null,
 *   pendingTransactionID: string|null,
 *   status: Status|value-of<Status>,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class AccountTransfer implements BaseModel
{
    /** @use SdkModel<AccountTransferShape> */
    use SdkModel;

    /**
     * The Account Transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account from which the transfer originated.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The transfer amount in cents. This will always be positive and indicates the amount of money leaving the originating account.
     */
    #[Required]
    public int $amount;

    /**
     * If your account requires approvals for transfers and the transfer was approved, this will contain details of the approval.
     */
    #[Required]
    public ?Approval $approval;

    /**
     * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
     */
    #[Required]
    public ?Cancellation $cancellation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * What object created the transfer, either via the API or the dashboard.
     */
    #[Required('created_by')]
    public ?CreatedBy $createdBy;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * An internal-facing description for the transfer for display in the API and dashboard. This will also show in the description of the created Transactions.
     */
    #[Required]
    public string $description;

    /**
     * The destination Account's identifier.
     */
    #[Required('destination_account_id')]
    public string $destinationAccountID;

    /**
     * The identifier of the Transaction on the destination Account representing the received funds.
     */
    #[Required('destination_transaction_id')]
    public ?string $destinationTransactionID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The identifier of the Transaction on the originating account representing the transferred funds.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `account_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new AccountTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   amount: ...,
     *   approval: ...,
     *   cancellation: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   currency: ...,
     *   description: ...,
     *   destinationAccountID: ...,
     *   destinationTransactionID: ...,
     *   idempotencyKey: ...,
     *   pendingTransactionID: ...,
     *   status: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withApproval(...)
     *   ->withCancellation(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCurrency(...)
     *   ->withDescription(...)
     *   ->withDestinationAccountID(...)
     *   ->withDestinationTransactionID(...)
     *   ->withIdempotencyKey(...)
     *   ->withPendingTransactionID(...)
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
     * @param Approval|ApprovalShape|null $approval
     * @param Cancellation|CancellationShape|null $cancellation
     * @param CreatedBy|CreatedByShape|null $createdBy
     * @param Currency|value-of<Currency> $currency
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        int $amount,
        Approval|array|null $approval,
        Cancellation|array|null $cancellation,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        Currency|string $currency,
        string $description,
        string $destinationAccountID,
        ?string $destinationTransactionID,
        ?string $idempotencyKey,
        ?string $pendingTransactionID,
        Status|string $status,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['approval'] = $approval;
        $self['cancellation'] = $cancellation;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['currency'] = $currency;
        $self['description'] = $description;
        $self['destinationAccountID'] = $destinationAccountID;
        $self['destinationTransactionID'] = $destinationTransactionID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['status'] = $status;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Account Transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account from which the transfer originated.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The transfer amount in cents. This will always be positive and indicates the amount of money leaving the originating account.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * If your account requires approvals for transfers and the transfer was approved, this will contain details of the approval.
     *
     * @param Approval|ApprovalShape|null $approval
     */
    public function withApproval(Approval|array|null $approval): self
    {
        $self = clone $this;
        $self['approval'] = $approval;

        return $self;
    }

    /**
     * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
     *
     * @param Cancellation|CancellationShape|null $cancellation
     */
    public function withCancellation(
        Cancellation|array|null $cancellation
    ): self {
        $self = clone $this;
        $self['cancellation'] = $cancellation;

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
     * What object created the transfer, either via the API or the dashboard.
     *
     * @param CreatedBy|CreatedByShape|null $createdBy
     */
    public function withCreatedBy(CreatedBy|array|null $createdBy): self
    {
        $self = clone $this;
        $self['createdBy'] = $createdBy;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * An internal-facing description for the transfer for display in the API and dashboard. This will also show in the description of the created Transactions.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The destination Account's identifier.
     */
    public function withDestinationAccountID(string $destinationAccountID): self
    {
        $self = clone $this;
        $self['destinationAccountID'] = $destinationAccountID;

        return $self;
    }

    /**
     * The identifier of the Transaction on the destination Account representing the received funds.
     */
    public function withDestinationTransactionID(
        ?string $destinationTransactionID
    ): self {
        $self = clone $this;
        $self['destinationTransactionID'] = $destinationTransactionID;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

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
     * The identifier of the Transaction on the originating account representing the transferred funds.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `account_transfer`.
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

<?php

declare(strict_types=1);

namespace Increase\WireTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransfer\Approval;
use Increase\WireTransfers\WireTransfer\Cancellation;
use Increase\WireTransfers\WireTransfer\CreatedBy;
use Increase\WireTransfers\WireTransfer\Creditor;
use Increase\WireTransfers\WireTransfer\Currency;
use Increase\WireTransfers\WireTransfer\Debtor;
use Increase\WireTransfers\WireTransfer\Network;
use Increase\WireTransfers\WireTransfer\Remittance;
use Increase\WireTransfers\WireTransfer\Reversal;
use Increase\WireTransfers\WireTransfer\Status;
use Increase\WireTransfers\WireTransfer\Submission;
use Increase\WireTransfers\WireTransfer\Type;

/**
 * Wire transfers move funds between your Increase account and any other account accessible by Fedwire.
 *
 * @phpstan-import-type ApprovalShape from \Increase\WireTransfers\WireTransfer\Approval
 * @phpstan-import-type CancellationShape from \Increase\WireTransfers\WireTransfer\Cancellation
 * @phpstan-import-type CreatedByShape from \Increase\WireTransfers\WireTransfer\CreatedBy
 * @phpstan-import-type CreditorShape from \Increase\WireTransfers\WireTransfer\Creditor
 * @phpstan-import-type DebtorShape from \Increase\WireTransfers\WireTransfer\Debtor
 * @phpstan-import-type RemittanceShape from \Increase\WireTransfers\WireTransfer\Remittance
 * @phpstan-import-type ReversalShape from \Increase\WireTransfers\WireTransfer\Reversal
 * @phpstan-import-type SubmissionShape from \Increase\WireTransfers\WireTransfer\Submission
 *
 * @phpstan-type WireTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   amount: int,
 *   approval: null|Approval|ApprovalShape,
 *   cancellation: null|Cancellation|CancellationShape,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   creditor: null|Creditor|CreditorShape,
 *   currency: Currency|value-of<Currency>,
 *   debtor: null|Debtor|DebtorShape,
 *   externalAccountID: string|null,
 *   idempotencyKey: string|null,
 *   inboundWireDrawdownRequestID: string|null,
 *   network: Network|value-of<Network>,
 *   pendingTransactionID: string|null,
 *   remittance: null|Remittance|RemittanceShape,
 *   reversal: null|Reversal|ReversalShape,
 *   routingNumber: string,
 *   sourceAccountNumberID: string|null,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class WireTransfer implements BaseModel
{
    /** @use SdkModel<WireTransferShape> */
    use SdkModel;

    /**
     * The wire transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account to which the transfer belongs.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The destination account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The transfer amount in USD cents.
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
     * The person or business that is receiving the funds from the transfer.
     */
    #[Required]
    public ?Creditor $creditor;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For wire transfers this is always equal to `usd`.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The person or business whose funds are being transferred.
     */
    #[Required]
    public ?Debtor $debtor;

    /**
     * The identifier of the External Account the transfer was made to, if any.
     */
    #[Required('external_account_id')]
    public ?string $externalAccountID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The ID of an Inbound Wire Drawdown Request in response to which this transfer was sent.
     */
    #[Required('inbound_wire_drawdown_request_id')]
    public ?string $inboundWireDrawdownRequestID;

    /**
     * The transfer's network.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * Remittance information sent with the wire transfer.
     */
    #[Required]
    public ?Remittance $remittance;

    /**
     * If your transfer is reversed, this will contain details of the reversal.
     */
    #[Required]
    public ?Reversal $reversal;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The Account Number that was passed to the wire's recipient.
     */
    #[Required('source_account_number_id')]
    public ?string $sourceAccountNumberID;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the transfer is submitted to Fedwire, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * The ID for the transaction funding the transfer.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `wire_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new WireTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WireTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   amount: ...,
     *   approval: ...,
     *   cancellation: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   creditor: ...,
     *   currency: ...,
     *   debtor: ...,
     *   externalAccountID: ...,
     *   idempotencyKey: ...,
     *   inboundWireDrawdownRequestID: ...,
     *   network: ...,
     *   pendingTransactionID: ...,
     *   remittance: ...,
     *   reversal: ...,
     *   routingNumber: ...,
     *   sourceAccountNumberID: ...,
     *   status: ...,
     *   submission: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WireTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withAmount(...)
     *   ->withApproval(...)
     *   ->withCancellation(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCreditor(...)
     *   ->withCurrency(...)
     *   ->withDebtor(...)
     *   ->withExternalAccountID(...)
     *   ->withIdempotencyKey(...)
     *   ->withInboundWireDrawdownRequestID(...)
     *   ->withNetwork(...)
     *   ->withPendingTransactionID(...)
     *   ->withRemittance(...)
     *   ->withReversal(...)
     *   ->withRoutingNumber(...)
     *   ->withSourceAccountNumberID(...)
     *   ->withStatus(...)
     *   ->withSubmission(...)
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
     * @param Creditor|CreditorShape|null $creditor
     * @param Currency|value-of<Currency> $currency
     * @param Debtor|DebtorShape|null $debtor
     * @param Network|value-of<Network> $network
     * @param Remittance|RemittanceShape|null $remittance
     * @param Reversal|ReversalShape|null $reversal
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        int $amount,
        Approval|array|null $approval,
        Cancellation|array|null $cancellation,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        Creditor|array|null $creditor,
        Currency|string $currency,
        Debtor|array|null $debtor,
        ?string $externalAccountID,
        ?string $idempotencyKey,
        ?string $inboundWireDrawdownRequestID,
        Network|string $network,
        ?string $pendingTransactionID,
        Remittance|array|null $remittance,
        Reversal|array|null $reversal,
        string $routingNumber,
        ?string $sourceAccountNumberID,
        Status|string $status,
        Submission|array|null $submission,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['amount'] = $amount;
        $self['approval'] = $approval;
        $self['cancellation'] = $cancellation;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['creditor'] = $creditor;
        $self['currency'] = $currency;
        $self['debtor'] = $debtor;
        $self['externalAccountID'] = $externalAccountID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['inboundWireDrawdownRequestID'] = $inboundWireDrawdownRequestID;
        $self['network'] = $network;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['remittance'] = $remittance;
        $self['reversal'] = $reversal;
        $self['routingNumber'] = $routingNumber;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The wire transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account to which the transfer belongs.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The destination account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

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
     * The person or business that is receiving the funds from the transfer.
     *
     * @param Creditor|CreditorShape|null $creditor
     */
    public function withCreditor(Creditor|array|null $creditor): self
    {
        $self = clone $this;
        $self['creditor'] = $creditor;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For wire transfers this is always equal to `usd`.
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
     * The person or business whose funds are being transferred.
     *
     * @param Debtor|DebtorShape|null $debtor
     */
    public function withDebtor(Debtor|array|null $debtor): self
    {
        $self = clone $this;
        $self['debtor'] = $debtor;

        return $self;
    }

    /**
     * The identifier of the External Account the transfer was made to, if any.
     */
    public function withExternalAccountID(?string $externalAccountID): self
    {
        $self = clone $this;
        $self['externalAccountID'] = $externalAccountID;

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
     * The ID of an Inbound Wire Drawdown Request in response to which this transfer was sent.
     */
    public function withInboundWireDrawdownRequestID(
        ?string $inboundWireDrawdownRequestID
    ): self {
        $self = clone $this;
        $self['inboundWireDrawdownRequestID'] = $inboundWireDrawdownRequestID;

        return $self;
    }

    /**
     * The transfer's network.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

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
     * Remittance information sent with the wire transfer.
     *
     * @param Remittance|RemittanceShape|null $remittance
     */
    public function withRemittance(Remittance|array|null $remittance): self
    {
        $self = clone $this;
        $self['remittance'] = $remittance;

        return $self;
    }

    /**
     * If your transfer is reversed, this will contain details of the reversal.
     *
     * @param Reversal|ReversalShape|null $reversal
     */
    public function withReversal(Reversal|array|null $reversal): self
    {
        $self = clone $this;
        $self['reversal'] = $reversal;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The Account Number that was passed to the wire's recipient.
     */
    public function withSourceAccountNumberID(
        ?string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

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
     * After the transfer is submitted to Fedwire, this will contain supplemental details.
     *
     * @param Submission|SubmissionShape|null $submission
     */
    public function withSubmission(Submission|array|null $submission): self
    {
        $self = clone $this;
        $self['submission'] = $submission;

        return $self;
    }

    /**
     * The ID for the transaction funding the transfer.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `wire_transfer`.
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

<?php

declare(strict_types=1);

namespace Increase\FednowTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\FednowTransfers\FednowTransfer\Acknowledgement;
use Increase\FednowTransfers\FednowTransfer\CreatedBy;
use Increase\FednowTransfers\FednowTransfer\Currency;
use Increase\FednowTransfers\FednowTransfer\Rejection;
use Increase\FednowTransfers\FednowTransfer\Status;
use Increase\FednowTransfers\FednowTransfer\Submission;
use Increase\FednowTransfers\FednowTransfer\Type;

/**
 * FedNow transfers move funds, within seconds, between your Increase account and any other account supporting FedNow.
 *
 * @phpstan-import-type AcknowledgementShape from \Increase\FednowTransfers\FednowTransfer\Acknowledgement
 * @phpstan-import-type CreatedByShape from \Increase\FednowTransfers\FednowTransfer\CreatedBy
 * @phpstan-import-type RejectionShape from \Increase\FednowTransfers\FednowTransfer\Rejection
 * @phpstan-import-type SubmissionShape from \Increase\FednowTransfers\FednowTransfer\Submission
 *
 * @phpstan-type FednowTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   acknowledgement: null|Acknowledgement|AcknowledgementShape,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   creditorName: string,
 *   currency: Currency|value-of<Currency>,
 *   debtorName: string,
 *   externalAccountID: string|null,
 *   idempotencyKey: string|null,
 *   pendingTransactionID: string|null,
 *   rejection: null|Rejection|RejectionShape,
 *   routingNumber: string,
 *   sourceAccountNumberID: string,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 *   uniqueEndToEndTransactionReference: string,
 *   unstructuredRemittanceInformation: string,
 * }
 */
final class FednowTransfer implements BaseModel
{
    /** @use SdkModel<FednowTransferShape> */
    use SdkModel;

    /**
     * The FedNow Transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account from which the transfer was sent.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The destination account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * If the transfer is acknowledged by the recipient bank, this will contain supplemental details.
     */
    #[Required]
    public ?Acknowledgement $acknowledgement;

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
     * What object created the transfer, either via the API or the dashboard.
     */
    #[Required('created_by')]
    public ?CreatedBy $createdBy;

    /**
     * The name of the transfer's recipient. This is set by the sender when creating the transfer.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For FedNow transfers this is always equal to `USD`.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The name of the transfer's sender. If not provided, defaults to the name of the account's entity.
     */
    #[Required('debtor_name')]
    public string $debtorName;

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
     * The ID for the pending transaction representing the transfer.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * If the transfer is rejected by FedNow or the destination financial institution, this will contain supplemental details.
     */
    #[Required]
    public ?Rejection $rejection;

    /**
     * The destination American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The Account Number the recipient will see as having sent the transfer.
     */
    #[Required('source_account_number_id')]
    public string $sourceAccountNumberID;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the transfer is submitted to FedNow, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * The Transaction funding the transfer once it is complete.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `fednow_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the transfer.
     */
    #[Required('unique_end_to_end_transaction_reference')]
    public string $uniqueEndToEndTransactionReference;

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * `new FednowTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FednowTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   acknowledgement: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   creditorName: ...,
     *   currency: ...,
     *   debtorName: ...,
     *   externalAccountID: ...,
     *   idempotencyKey: ...,
     *   pendingTransactionID: ...,
     *   rejection: ...,
     *   routingNumber: ...,
     *   sourceAccountNumberID: ...,
     *   status: ...,
     *   submission: ...,
     *   transactionID: ...,
     *   type: ...,
     *   uniqueEndToEndTransactionReference: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FednowTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withAcknowledgement(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCreditorName(...)
     *   ->withCurrency(...)
     *   ->withDebtorName(...)
     *   ->withExternalAccountID(...)
     *   ->withIdempotencyKey(...)
     *   ->withPendingTransactionID(...)
     *   ->withRejection(...)
     *   ->withRoutingNumber(...)
     *   ->withSourceAccountNumberID(...)
     *   ->withStatus(...)
     *   ->withSubmission(...)
     *   ->withTransactionID(...)
     *   ->withType(...)
     *   ->withUniqueEndToEndTransactionReference(...)
     *   ->withUnstructuredRemittanceInformation(...)
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
     * @param Acknowledgement|AcknowledgementShape|null $acknowledgement
     * @param CreatedBy|CreatedByShape|null $createdBy
     * @param Currency|value-of<Currency> $currency
     * @param Rejection|RejectionShape|null $rejection
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        Acknowledgement|array|null $acknowledgement,
        int $amount,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        string $creditorName,
        Currency|string $currency,
        string $debtorName,
        ?string $externalAccountID,
        ?string $idempotencyKey,
        ?string $pendingTransactionID,
        Rejection|array|null $rejection,
        string $routingNumber,
        string $sourceAccountNumberID,
        Status|string $status,
        Submission|array|null $submission,
        ?string $transactionID,
        Type|string $type,
        string $uniqueEndToEndTransactionReference,
        string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['acknowledgement'] = $acknowledgement;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['creditorName'] = $creditorName;
        $self['currency'] = $currency;
        $self['debtorName'] = $debtorName;
        $self['externalAccountID'] = $externalAccountID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['rejection'] = $rejection;
        $self['routingNumber'] = $routingNumber;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The FedNow Transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account from which the transfer was sent.
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
     * If the transfer is acknowledged by the recipient bank, this will contain supplemental details.
     *
     * @param Acknowledgement|AcknowledgementShape|null $acknowledgement
     */
    public function withAcknowledgement(
        Acknowledgement|array|null $acknowledgement
    ): self {
        $self = clone $this;
        $self['acknowledgement'] = $acknowledgement;

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
     * The name of the transfer's recipient. This is set by the sender when creating the transfer.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For FedNow transfers this is always equal to `USD`.
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
     * The name of the transfer's sender. If not provided, defaults to the name of the account's entity.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

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
     * The ID for the pending transaction representing the transfer.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * If the transfer is rejected by FedNow or the destination financial institution, this will contain supplemental details.
     *
     * @param Rejection|RejectionShape|null $rejection
     */
    public function withRejection(Rejection|array|null $rejection): self
    {
        $self = clone $this;
        $self['rejection'] = $rejection;

        return $self;
    }

    /**
     * The destination American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The Account Number the recipient will see as having sent the transfer.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
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
     * After the transfer is submitted to FedNow, this will contain supplemental details.
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
     * The Transaction funding the transfer once it is complete.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `fednow_transfer`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the transfer.
     */
    public function withUniqueEndToEndTransactionReference(
        string $uniqueEndToEndTransactionReference
    ): self {
        $self = clone $this;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;

        return $self;
    }

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

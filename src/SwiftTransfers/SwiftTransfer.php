<?php

declare(strict_types=1);

namespace Increase\SwiftTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\SwiftTransfers\SwiftTransfer\CreatedBy;
use Increase\SwiftTransfers\SwiftTransfer\CreditorAddress;
use Increase\SwiftTransfers\SwiftTransfer\DebtorAddress;
use Increase\SwiftTransfers\SwiftTransfer\InstructedCurrency;
use Increase\SwiftTransfers\SwiftTransfer\Status;
use Increase\SwiftTransfers\SwiftTransfer\Type;

/**
 * Swift Transfers send funds internationally.
 *
 * @phpstan-import-type CreatedByShape from \Increase\SwiftTransfers\SwiftTransfer\CreatedBy
 * @phpstan-import-type CreditorAddressShape from \Increase\SwiftTransfers\SwiftTransfer\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\SwiftTransfers\SwiftTransfer\DebtorAddress
 *
 * @phpstan-type SwiftTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   amount: int,
 *   bankIdentificationCode: string,
 *   createdAt: \DateTimeInterface,
 *   createdBy: CreatedBy|CreatedByShape,
 *   creditorAddress: CreditorAddress|CreditorAddressShape,
 *   creditorName: string,
 *   debtorAddress: DebtorAddress|DebtorAddressShape,
 *   debtorName: string,
 *   idempotencyKey: string|null,
 *   instructedAmount: int,
 *   instructedCurrency: InstructedCurrency|value-of<InstructedCurrency>,
 *   pendingTransactionID: string|null,
 *   routingNumber: string|null,
 *   sourceAccountNumberID: string,
 *   status: Status|value-of<Status>,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 *   uniqueEndToEndTransactionReference: string,
 *   unstructuredRemittanceInformation: string,
 * }
 */
final class SwiftTransfer implements BaseModel
{
    /** @use SdkModel<SwiftTransferShape> */
    use SdkModel;

    /**
     * The Swift transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account to which the transfer belongs.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The creditor's account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The bank identification code (BIC) of the creditor.
     */
    #[Required('bank_identification_code')]
    public string $bankIdentificationCode;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * What object created the transfer, either via the API or the dashboard.
     */
    #[Required('created_by')]
    public CreatedBy $createdBy;

    /**
     * The creditor's address.
     */
    #[Required('creditor_address')]
    public CreditorAddress $creditorAddress;

    /**
     * The creditor's name.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The debtor's address.
     */
    #[Required('debtor_address')]
    public DebtorAddress $debtorAddress;

    /**
     * The debtor's name.
     */
    #[Required('debtor_name')]
    public string $debtorName;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The amount that was instructed to be transferred in minor units of the `instructed_currency`.
     */
    #[Required('instructed_amount')]
    public int $instructedAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code of the instructed amount.
     *
     * @var value-of<InstructedCurrency> $instructedCurrency
     */
    #[Required('instructed_currency', enum: InstructedCurrency::class)]
    public string $instructedCurrency;

    /**
     * The ID for the pending transaction representing the transfer.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * The creditor's bank account routing or transit number. Required in certain countries.
     */
    #[Required('routing_number')]
    public ?string $routingNumber;

    /**
     * The Account Number included in the transfer as the debtor's account number.
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
     * The ID for the transaction funding the transfer. This will be populated after the transfer is initiated.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `swift_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) for the transfer.
     */
    #[Required('unique_end_to_end_transaction_reference')]
    public string $uniqueEndToEndTransactionReference;

    /**
     * The unstructured remittance information that was included with the transfer.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * `new SwiftTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SwiftTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   amount: ...,
     *   bankIdentificationCode: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   creditorAddress: ...,
     *   creditorName: ...,
     *   debtorAddress: ...,
     *   debtorName: ...,
     *   idempotencyKey: ...,
     *   instructedAmount: ...,
     *   instructedCurrency: ...,
     *   pendingTransactionID: ...,
     *   routingNumber: ...,
     *   sourceAccountNumberID: ...,
     *   status: ...,
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
     * (new SwiftTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withAmount(...)
     *   ->withBankIdentificationCode(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCreditorAddress(...)
     *   ->withCreditorName(...)
     *   ->withDebtorAddress(...)
     *   ->withDebtorName(...)
     *   ->withIdempotencyKey(...)
     *   ->withInstructedAmount(...)
     *   ->withInstructedCurrency(...)
     *   ->withPendingTransactionID(...)
     *   ->withRoutingNumber(...)
     *   ->withSourceAccountNumberID(...)
     *   ->withStatus(...)
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
     * @param CreatedBy|CreatedByShape $createdBy
     * @param CreditorAddress|CreditorAddressShape $creditorAddress
     * @param DebtorAddress|DebtorAddressShape $debtorAddress
     * @param InstructedCurrency|value-of<InstructedCurrency> $instructedCurrency
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        int $amount,
        string $bankIdentificationCode,
        \DateTimeInterface $createdAt,
        CreatedBy|array $createdBy,
        CreditorAddress|array $creditorAddress,
        string $creditorName,
        DebtorAddress|array $debtorAddress,
        string $debtorName,
        ?string $idempotencyKey,
        int $instructedAmount,
        InstructedCurrency|string $instructedCurrency,
        ?string $pendingTransactionID,
        ?string $routingNumber,
        string $sourceAccountNumberID,
        Status|string $status,
        ?string $transactionID,
        Type|string $type,
        string $uniqueEndToEndTransactionReference,
        string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['amount'] = $amount;
        $self['bankIdentificationCode'] = $bankIdentificationCode;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['creditorAddress'] = $creditorAddress;
        $self['creditorName'] = $creditorName;
        $self['debtorAddress'] = $debtorAddress;
        $self['debtorName'] = $debtorName;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['instructedAmount'] = $instructedAmount;
        $self['instructedCurrency'] = $instructedCurrency;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['routingNumber'] = $routingNumber;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['status'] = $status;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The Swift transfer's identifier.
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
     * The creditor's account number.
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
     * The bank identification code (BIC) of the creditor.
     */
    public function withBankIdentificationCode(
        string $bankIdentificationCode
    ): self {
        $self = clone $this;
        $self['bankIdentificationCode'] = $bankIdentificationCode;

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
     * @param CreatedBy|CreatedByShape $createdBy
     */
    public function withCreatedBy(CreatedBy|array $createdBy): self
    {
        $self = clone $this;
        $self['createdBy'] = $createdBy;

        return $self;
    }

    /**
     * The creditor's address.
     *
     * @param CreditorAddress|CreditorAddressShape $creditorAddress
     */
    public function withCreditorAddress(
        CreditorAddress|array $creditorAddress
    ): self {
        $self = clone $this;
        $self['creditorAddress'] = $creditorAddress;

        return $self;
    }

    /**
     * The creditor's name.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The debtor's address.
     *
     * @param DebtorAddress|DebtorAddressShape $debtorAddress
     */
    public function withDebtorAddress(DebtorAddress|array $debtorAddress): self
    {
        $self = clone $this;
        $self['debtorAddress'] = $debtorAddress;

        return $self;
    }

    /**
     * The debtor's name.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

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
     * The amount that was instructed to be transferred in minor units of the `instructed_currency`.
     */
    public function withInstructedAmount(int $instructedAmount): self
    {
        $self = clone $this;
        $self['instructedAmount'] = $instructedAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code of the instructed amount.
     *
     * @param InstructedCurrency|value-of<InstructedCurrency> $instructedCurrency
     */
    public function withInstructedCurrency(
        InstructedCurrency|string $instructedCurrency
    ): self {
        $self = clone $this;
        $self['instructedCurrency'] = $instructedCurrency;

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
     * The creditor's bank account routing or transit number. Required in certain countries.
     */
    public function withRoutingNumber(?string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The Account Number included in the transfer as the debtor's account number.
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
     * The ID for the transaction funding the transfer. This will be populated after the transfer is initiated.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `swift_transfer`.
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
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) for the transfer.
     */
    public function withUniqueEndToEndTransactionReference(
        string $uniqueEndToEndTransactionReference
    ): self {
        $self = clone $this;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;

        return $self;
    }

    /**
     * The unstructured remittance information that was included with the transfer.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Acknowledgement;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Approval;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Cancellation;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\CreatedBy;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Currency;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Rejection;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Status;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Submission;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Type;

/**
 * Real-Time Payments transfers move funds, within seconds, between your Increase account and any other account on the Real-Time Payments network.
 *
 * @phpstan-import-type AcknowledgementShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Acknowledgement
 * @phpstan-import-type ApprovalShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Approval
 * @phpstan-import-type CancellationShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Cancellation
 * @phpstan-import-type CreatedByShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\CreatedBy
 * @phpstan-import-type RejectionShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Rejection
 * @phpstan-import-type SubmissionShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer\Submission
 *
 * @phpstan-type RealTimePaymentsTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   acknowledgement: null|Acknowledgement|AcknowledgementShape,
 *   amount: int,
 *   approval: null|Approval|ApprovalShape,
 *   cancellation: null|Cancellation|CancellationShape,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   creditorName: string,
 *   currency: Currency|value-of<Currency>,
 *   debtorName: string|null,
 *   destinationAccountNumber: string,
 *   destinationRoutingNumber: string,
 *   externalAccountID: string|null,
 *   idempotencyKey: string|null,
 *   pendingTransactionID: string|null,
 *   rejection: null|Rejection|RejectionShape,
 *   remittanceInformation: string,
 *   sourceAccountNumberID: string,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 *   ultimateCreditorName: string|null,
 *   ultimateDebtorName: string|null,
 * }
 */
final class RealTimePaymentsTransfer implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsTransferShape> */
    use SdkModel;

    /**
     * The Real-Time Payments Transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account from which the transfer was sent.
     */
    #[Required('account_id')]
    public string $accountID;

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
     * The name of the transfer's recipient. This is set by the sender when creating the transfer.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For real-time payments transfers this is always equal to `USD`.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The name of the transfer's sender. If not provided, defaults to the name of the account's entity.
     */
    #[Required('debtor_name')]
    public ?string $debtorName;

    /**
     * The destination account number.
     */
    #[Required('destination_account_number')]
    public string $destinationAccountNumber;

    /**
     * The destination American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('destination_routing_number')]
    public string $destinationRoutingNumber;

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
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * If the transfer is rejected by Real-Time Payments or the destination financial institution, this will contain supplemental details.
     */
    #[Required]
    public ?Rejection $rejection;

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    #[Required('remittance_information')]
    public string $remittanceInformation;

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
     * After the transfer is submitted to Real-Time Payments, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * The Transaction funding the transfer once it is complete.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `real_time_payments_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The name of the ultimate recipient of the transfer. Set this if the creditor is an intermediary receiving the payment for someone else.
     */
    #[Required('ultimate_creditor_name')]
    public ?string $ultimateCreditorName;

    /**
     * The name of the ultimate sender of the transfer. Set this if the funds are being sent on behalf of someone who is not the account holder at Increase.
     */
    #[Required('ultimate_debtor_name')]
    public ?string $ultimateDebtorName;

    /**
     * `new RealTimePaymentsTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimePaymentsTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   acknowledgement: ...,
     *   amount: ...,
     *   approval: ...,
     *   cancellation: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   creditorName: ...,
     *   currency: ...,
     *   debtorName: ...,
     *   destinationAccountNumber: ...,
     *   destinationRoutingNumber: ...,
     *   externalAccountID: ...,
     *   idempotencyKey: ...,
     *   pendingTransactionID: ...,
     *   rejection: ...,
     *   remittanceInformation: ...,
     *   sourceAccountNumberID: ...,
     *   status: ...,
     *   submission: ...,
     *   transactionID: ...,
     *   type: ...,
     *   ultimateCreditorName: ...,
     *   ultimateDebtorName: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimePaymentsTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAcknowledgement(...)
     *   ->withAmount(...)
     *   ->withApproval(...)
     *   ->withCancellation(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCreditorName(...)
     *   ->withCurrency(...)
     *   ->withDebtorName(...)
     *   ->withDestinationAccountNumber(...)
     *   ->withDestinationRoutingNumber(...)
     *   ->withExternalAccountID(...)
     *   ->withIdempotencyKey(...)
     *   ->withPendingTransactionID(...)
     *   ->withRejection(...)
     *   ->withRemittanceInformation(...)
     *   ->withSourceAccountNumberID(...)
     *   ->withStatus(...)
     *   ->withSubmission(...)
     *   ->withTransactionID(...)
     *   ->withType(...)
     *   ->withUltimateCreditorName(...)
     *   ->withUltimateDebtorName(...)
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
     * @param Approval|ApprovalShape|null $approval
     * @param Cancellation|CancellationShape|null $cancellation
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
        Acknowledgement|array|null $acknowledgement,
        int $amount,
        Approval|array|null $approval,
        Cancellation|array|null $cancellation,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        string $creditorName,
        Currency|string $currency,
        ?string $debtorName,
        string $destinationAccountNumber,
        string $destinationRoutingNumber,
        ?string $externalAccountID,
        ?string $idempotencyKey,
        ?string $pendingTransactionID,
        Rejection|array|null $rejection,
        string $remittanceInformation,
        string $sourceAccountNumberID,
        Status|string $status,
        Submission|array|null $submission,
        ?string $transactionID,
        Type|string $type,
        ?string $ultimateCreditorName,
        ?string $ultimateDebtorName,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['acknowledgement'] = $acknowledgement;
        $self['amount'] = $amount;
        $self['approval'] = $approval;
        $self['cancellation'] = $cancellation;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['creditorName'] = $creditorName;
        $self['currency'] = $currency;
        $self['debtorName'] = $debtorName;
        $self['destinationAccountNumber'] = $destinationAccountNumber;
        $self['destinationRoutingNumber'] = $destinationRoutingNumber;
        $self['externalAccountID'] = $externalAccountID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['rejection'] = $rejection;
        $self['remittanceInformation'] = $remittanceInformation;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;
        $self['ultimateCreditorName'] = $ultimateCreditorName;
        $self['ultimateDebtorName'] = $ultimateDebtorName;

        return $self;
    }

    /**
     * The Real-Time Payments Transfer's identifier.
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
     * The name of the transfer's recipient. This is set by the sender when creating the transfer.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For real-time payments transfers this is always equal to `USD`.
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
    public function withDebtorName(?string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

        return $self;
    }

    /**
     * The destination account number.
     */
    public function withDestinationAccountNumber(
        string $destinationAccountNumber
    ): self {
        $self = clone $this;
        $self['destinationAccountNumber'] = $destinationAccountNumber;

        return $self;
    }

    /**
     * The destination American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withDestinationRoutingNumber(
        string $destinationRoutingNumber
    ): self {
        $self = clone $this;
        $self['destinationRoutingNumber'] = $destinationRoutingNumber;

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
     * If the transfer is rejected by Real-Time Payments or the destination financial institution, this will contain supplemental details.
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
     * Unstructured information that will show on the recipient's bank statement.
     */
    public function withRemittanceInformation(
        string $remittanceInformation
    ): self {
        $self = clone $this;
        $self['remittanceInformation'] = $remittanceInformation;

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
     * After the transfer is submitted to Real-Time Payments, this will contain supplemental details.
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
     * A constant representing the object's type. For this resource it will always be `real_time_payments_transfer`.
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
     * The name of the ultimate recipient of the transfer. Set this if the creditor is an intermediary receiving the payment for someone else.
     */
    public function withUltimateCreditorName(
        ?string $ultimateCreditorName
    ): self {
        $self = clone $this;
        $self['ultimateCreditorName'] = $ultimateCreditorName;

        return $self;
    }

    /**
     * The name of the ultimate sender of the transfer. Set this if the funds are being sent on behalf of someone who is not the account holder at Increase.
     */
    public function withUltimateDebtorName(?string $ultimateDebtorName): self
    {
        $self = clone $this;
        $self['ultimateDebtorName'] = $ultimateDebtorName;

        return $self;
    }
}

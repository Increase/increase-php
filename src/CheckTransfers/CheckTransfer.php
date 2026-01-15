<?php

declare(strict_types=1);

namespace Increase\CheckTransfers;

use Increase\CheckTransfers\CheckTransfer\Approval;
use Increase\CheckTransfers\CheckTransfer\BalanceCheck;
use Increase\CheckTransfers\CheckTransfer\Cancellation;
use Increase\CheckTransfers\CheckTransfer\CreatedBy;
use Increase\CheckTransfers\CheckTransfer\Currency;
use Increase\CheckTransfers\CheckTransfer\FulfillmentMethod;
use Increase\CheckTransfers\CheckTransfer\Mailing;
use Increase\CheckTransfers\CheckTransfer\PhysicalCheck;
use Increase\CheckTransfers\CheckTransfer\Status;
use Increase\CheckTransfers\CheckTransfer\StopPaymentRequest;
use Increase\CheckTransfers\CheckTransfer\Submission;
use Increase\CheckTransfers\CheckTransfer\ThirdParty;
use Increase\CheckTransfers\CheckTransfer\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Check Transfers move funds from your Increase account by mailing a physical check.
 *
 * @phpstan-import-type ApprovalShape from \Increase\CheckTransfers\CheckTransfer\Approval
 * @phpstan-import-type CancellationShape from \Increase\CheckTransfers\CheckTransfer\Cancellation
 * @phpstan-import-type CreatedByShape from \Increase\CheckTransfers\CheckTransfer\CreatedBy
 * @phpstan-import-type MailingShape from \Increase\CheckTransfers\CheckTransfer\Mailing
 * @phpstan-import-type PhysicalCheckShape from \Increase\CheckTransfers\CheckTransfer\PhysicalCheck
 * @phpstan-import-type StopPaymentRequestShape from \Increase\CheckTransfers\CheckTransfer\StopPaymentRequest
 * @phpstan-import-type SubmissionShape from \Increase\CheckTransfers\CheckTransfer\Submission
 * @phpstan-import-type ThirdPartyShape from \Increase\CheckTransfers\CheckTransfer\ThirdParty
 *
 * @phpstan-type CheckTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   amount: int,
 *   approval: null|Approval|ApprovalShape,
 *   approvedInboundCheckDepositID: string|null,
 *   balanceCheck: null|BalanceCheck|value-of<BalanceCheck>,
 *   cancellation: null|Cancellation|CancellationShape,
 *   checkNumber: string,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   currency: Currency|value-of<Currency>,
 *   fulfillmentMethod: FulfillmentMethod|value-of<FulfillmentMethod>,
 *   idempotencyKey: string|null,
 *   mailing: null|Mailing|MailingShape,
 *   pendingTransactionID: string|null,
 *   physicalCheck: null|PhysicalCheck|PhysicalCheckShape,
 *   routingNumber: string,
 *   sourceAccountNumberID: string|null,
 *   status: Status|value-of<Status>,
 *   stopPaymentRequest: null|StopPaymentRequest|StopPaymentRequestShape,
 *   submission: null|Submission|SubmissionShape,
 *   thirdParty: null|ThirdParty|ThirdPartyShape,
 *   type: Type|value-of<Type>,
 *   validUntilDate: string|null,
 * }
 */
final class CheckTransfer implements BaseModel
{
    /** @use SdkModel<CheckTransferShape> */
    use SdkModel;

    /**
     * The Check transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the Account from which funds will be transferred.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The account number printed on the check.
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
     * If the Check Transfer was successfully deposited, this will contain the identifier of the Inbound Check Deposit object with details of the deposit.
     */
    #[Required('approved_inbound_check_deposit_id')]
    public ?string $approvedInboundCheckDepositID;

    /**
     * How the account's available balance should be checked.
     *
     * @var value-of<BalanceCheck>|null $balanceCheck
     */
    #[Required('balance_check', enum: BalanceCheck::class)]
    public ?string $balanceCheck;

    /**
     * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
     */
    #[Required]
    public ?Cancellation $cancellation;

    /**
     * The check number printed on the check.
     */
    #[Required('check_number')]
    public string $checkNumber;

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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the check's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Whether Increase will print and mail the check or if you will do it yourself.
     *
     * @var value-of<FulfillmentMethod> $fulfillmentMethod
     */
    #[Required('fulfillment_method', enum: FulfillmentMethod::class)]
    public string $fulfillmentMethod;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * If the check has been mailed by Increase, this will contain details of the shipment.
     */
    #[Required]
    public ?Mailing $mailing;

    /**
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * Details relating to the physical check that Increase will print and mail. Will be present if and only if `fulfillment_method` is equal to `physical_check`.
     */
    #[Required('physical_check')]
    public ?PhysicalCheck $physicalCheck;

    /**
     * The routing number printed on the check.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The identifier of the Account Number from which to send the transfer and print on the check.
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
     * After a stop-payment is requested on the check, this will contain supplemental details.
     */
    #[Required('stop_payment_request')]
    public ?StopPaymentRequest $stopPaymentRequest;

    /**
     * After the transfer is submitted, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * Details relating to the custom fulfillment you will perform. Will be present if and only if `fulfillment_method` is equal to `third_party`.
     */
    #[Required('third_party')]
    public ?ThirdParty $thirdParty;

    /**
     * A constant representing the object's type. For this resource it will always be `check_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * If set, the check will be valid on or before this date. After this date, the check transfer will be automatically stopped and deposits will not be accepted. For checks printed by Increase, this date is included on the check as its expiry.
     */
    #[Required('valid_until_date')]
    public ?string $validUntilDate;

    /**
     * `new CheckTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   amount: ...,
     *   approval: ...,
     *   approvedInboundCheckDepositID: ...,
     *   balanceCheck: ...,
     *   cancellation: ...,
     *   checkNumber: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   currency: ...,
     *   fulfillmentMethod: ...,
     *   idempotencyKey: ...,
     *   mailing: ...,
     *   pendingTransactionID: ...,
     *   physicalCheck: ...,
     *   routingNumber: ...,
     *   sourceAccountNumberID: ...,
     *   status: ...,
     *   stopPaymentRequest: ...,
     *   submission: ...,
     *   thirdParty: ...,
     *   type: ...,
     *   validUntilDate: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withAmount(...)
     *   ->withApproval(...)
     *   ->withApprovedInboundCheckDepositID(...)
     *   ->withBalanceCheck(...)
     *   ->withCancellation(...)
     *   ->withCheckNumber(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCurrency(...)
     *   ->withFulfillmentMethod(...)
     *   ->withIdempotencyKey(...)
     *   ->withMailing(...)
     *   ->withPendingTransactionID(...)
     *   ->withPhysicalCheck(...)
     *   ->withRoutingNumber(...)
     *   ->withSourceAccountNumberID(...)
     *   ->withStatus(...)
     *   ->withStopPaymentRequest(...)
     *   ->withSubmission(...)
     *   ->withThirdParty(...)
     *   ->withType(...)
     *   ->withValidUntilDate(...)
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
     * @param BalanceCheck|value-of<BalanceCheck>|null $balanceCheck
     * @param Cancellation|CancellationShape|null $cancellation
     * @param CreatedBy|CreatedByShape|null $createdBy
     * @param Currency|value-of<Currency> $currency
     * @param FulfillmentMethod|value-of<FulfillmentMethod> $fulfillmentMethod
     * @param Mailing|MailingShape|null $mailing
     * @param PhysicalCheck|PhysicalCheckShape|null $physicalCheck
     * @param Status|value-of<Status> $status
     * @param StopPaymentRequest|StopPaymentRequestShape|null $stopPaymentRequest
     * @param Submission|SubmissionShape|null $submission
     * @param ThirdParty|ThirdPartyShape|null $thirdParty
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        int $amount,
        Approval|array|null $approval,
        ?string $approvedInboundCheckDepositID,
        BalanceCheck|string|null $balanceCheck,
        Cancellation|array|null $cancellation,
        string $checkNumber,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        Currency|string $currency,
        FulfillmentMethod|string $fulfillmentMethod,
        ?string $idempotencyKey,
        Mailing|array|null $mailing,
        ?string $pendingTransactionID,
        PhysicalCheck|array|null $physicalCheck,
        string $routingNumber,
        ?string $sourceAccountNumberID,
        Status|string $status,
        StopPaymentRequest|array|null $stopPaymentRequest,
        Submission|array|null $submission,
        ThirdParty|array|null $thirdParty,
        Type|string $type,
        ?string $validUntilDate,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['amount'] = $amount;
        $self['approval'] = $approval;
        $self['approvedInboundCheckDepositID'] = $approvedInboundCheckDepositID;
        $self['balanceCheck'] = $balanceCheck;
        $self['cancellation'] = $cancellation;
        $self['checkNumber'] = $checkNumber;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['currency'] = $currency;
        $self['fulfillmentMethod'] = $fulfillmentMethod;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['mailing'] = $mailing;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['physicalCheck'] = $physicalCheck;
        $self['routingNumber'] = $routingNumber;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['status'] = $status;
        $self['stopPaymentRequest'] = $stopPaymentRequest;
        $self['submission'] = $submission;
        $self['thirdParty'] = $thirdParty;
        $self['type'] = $type;
        $self['validUntilDate'] = $validUntilDate;

        return $self;
    }

    /**
     * The Check transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the Account from which funds will be transferred.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The account number printed on the check.
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
     * If the Check Transfer was successfully deposited, this will contain the identifier of the Inbound Check Deposit object with details of the deposit.
     */
    public function withApprovedInboundCheckDepositID(
        ?string $approvedInboundCheckDepositID
    ): self {
        $self = clone $this;
        $self['approvedInboundCheckDepositID'] = $approvedInboundCheckDepositID;

        return $self;
    }

    /**
     * How the account's available balance should be checked.
     *
     * @param BalanceCheck|value-of<BalanceCheck>|null $balanceCheck
     */
    public function withBalanceCheck(
        BalanceCheck|string|null $balanceCheck
    ): self {
        $self = clone $this;
        $self['balanceCheck'] = $balanceCheck;

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
     * The check number printed on the check.
     */
    public function withCheckNumber(string $checkNumber): self
    {
        $self = clone $this;
        $self['checkNumber'] = $checkNumber;

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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the check's currency.
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
     * Whether Increase will print and mail the check or if you will do it yourself.
     *
     * @param FulfillmentMethod|value-of<FulfillmentMethod> $fulfillmentMethod
     */
    public function withFulfillmentMethod(
        FulfillmentMethod|string $fulfillmentMethod
    ): self {
        $self = clone $this;
        $self['fulfillmentMethod'] = $fulfillmentMethod;

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
     * If the check has been mailed by Increase, this will contain details of the shipment.
     *
     * @param Mailing|MailingShape|null $mailing
     */
    public function withMailing(Mailing|array|null $mailing): self
    {
        $self = clone $this;
        $self['mailing'] = $mailing;

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
     * Details relating to the physical check that Increase will print and mail. Will be present if and only if `fulfillment_method` is equal to `physical_check`.
     *
     * @param PhysicalCheck|PhysicalCheckShape|null $physicalCheck
     */
    public function withPhysicalCheck(
        PhysicalCheck|array|null $physicalCheck
    ): self {
        $self = clone $this;
        $self['physicalCheck'] = $physicalCheck;

        return $self;
    }

    /**
     * The routing number printed on the check.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The identifier of the Account Number from which to send the transfer and print on the check.
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
     * After a stop-payment is requested on the check, this will contain supplemental details.
     *
     * @param StopPaymentRequest|StopPaymentRequestShape|null $stopPaymentRequest
     */
    public function withStopPaymentRequest(
        StopPaymentRequest|array|null $stopPaymentRequest
    ): self {
        $self = clone $this;
        $self['stopPaymentRequest'] = $stopPaymentRequest;

        return $self;
    }

    /**
     * After the transfer is submitted, this will contain supplemental details.
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
     * Details relating to the custom fulfillment you will perform. Will be present if and only if `fulfillment_method` is equal to `third_party`.
     *
     * @param ThirdParty|ThirdPartyShape|null $thirdParty
     */
    public function withThirdParty(ThirdParty|array|null $thirdParty): self
    {
        $self = clone $this;
        $self['thirdParty'] = $thirdParty;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `check_transfer`.
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
     * If set, the check will be valid on or before this date. After this date, the check transfer will be automatically stopped and deposits will not be accepted. For checks printed by Increase, this date is included on the check as its expiry.
     */
    public function withValidUntilDate(?string $validUntilDate): self
    {
        $self = clone $this;
        $self['validUntilDate'] = $validUntilDate;

        return $self;
    }
}

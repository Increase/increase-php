<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Cancellation;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Currency;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Debtor;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Refusal;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Rejection;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Status;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Submission;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Type;

/**
 * Real-Time Payments transfers move funds, within seconds, between your Increase account and any other account on the Real-Time Payments network. A request for payment is a request to the receiver to send funds to your account. The permitted uses of Requests For Payment are limited by the Real-Time Payments network to business-to-business payments and transfers between two accounts at different banks owned by the same individual. Please contact [support@increase.com](mailto:support@increase.com) to enable this API for your team.
 *
 * @phpstan-import-type CancellationShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Cancellation
 * @phpstan-import-type DebtorShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Debtor
 * @phpstan-import-type RefusalShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Refusal
 * @phpstan-import-type RejectionShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Rejection
 * @phpstan-import-type SubmissionShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Submission
 *
 * @phpstan-type RealTimePaymentsRequestForPaymentShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumberID: string,
 *   amount: int,
 *   cancellation: null|Cancellation|CancellationShape,
 *   createdAt: \DateTimeInterface,
 *   creditorName: string,
 *   currency: Currency|value-of<Currency>,
 *   debtor: Debtor|DebtorShape,
 *   debtorAccountNumber: string,
 *   debtorRoutingNumber: string,
 *   expiresAt: \DateTimeInterface,
 *   fulfillmentInboundRealTimePaymentsTransferID: string|null,
 *   idempotencyKey: string|null,
 *   refusal: null|Refusal|RefusalShape,
 *   rejection: null|Rejection|RejectionShape,
 *   requestedExecutionAt: \DateTimeInterface|null,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   type: Type|value-of<Type>,
 *   unstructuredRemittanceInformation: string,
 * }
 */
final class RealTimePaymentsRequestForPayment implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsRequestForPaymentShape> */
    use SdkModel;

    /**
     * The Real-Time Payments Request for Payment's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account in which a successful transfer will arrive.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Account Number in which a successful transfer will arrive.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * If a cancellation has been requested, this will contain supplemental details. The request for payment moves to `canceled` once the recipient bank acknowledges the cancellation.
     */
    #[Required]
    public ?Cancellation $cancellation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the request for payment was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The name of the creditor requesting the payment.
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
     * Details of the person being requested to pay.
     */
    #[Required]
    public Debtor $debtor;

    /**
     * The debtor's account number, which the request is sent to.
     */
    #[Required('debtor_account_number')]
    public string $debtorAccountNumber;

    /**
     * The debtor's American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('debtor_routing_number')]
    public string $debtorRoutingNumber;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid. After this time the debtor's bank should no longer allow the debtor to pay it.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * The identifier of the Inbound Real-Time Payments Transfer that fulfilled this request.
     */
    #[Required('fulfillment_inbound_real_time_payments_transfer_id')]
    public ?string $fulfillmentInboundRealTimePaymentsTransferID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * If the request for payment is refused by the destination financial institution or the receiving customer, this will contain supplemental details.
     */
    #[Required]
    public ?Refusal $refusal;

    /**
     * If the request for payment is rejected by Real-Time Payments or the destination financial institution, this will contain supplemental details.
     */
    #[Required]
    public ?Rejection $rejection;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which the payment was requested to be made.
     */
    #[Required('requested_execution_at')]
    public ?\DateTimeInterface $requestedExecutionAt;

    /**
     * The lifecycle status of the request for payment.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the request for payment is submitted to Real-Time Payments, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * A constant representing the object's type. For this resource it will always be `real_time_payments_request_for_payment`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * `new RealTimePaymentsRequestForPayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimePaymentsRequestForPayment::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumberID: ...,
     *   amount: ...,
     *   cancellation: ...,
     *   createdAt: ...,
     *   creditorName: ...,
     *   currency: ...,
     *   debtor: ...,
     *   debtorAccountNumber: ...,
     *   debtorRoutingNumber: ...,
     *   expiresAt: ...,
     *   fulfillmentInboundRealTimePaymentsTransferID: ...,
     *   idempotencyKey: ...,
     *   refusal: ...,
     *   rejection: ...,
     *   requestedExecutionAt: ...,
     *   status: ...,
     *   submission: ...,
     *   type: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimePaymentsRequestForPayment)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withCancellation(...)
     *   ->withCreatedAt(...)
     *   ->withCreditorName(...)
     *   ->withCurrency(...)
     *   ->withDebtor(...)
     *   ->withDebtorAccountNumber(...)
     *   ->withDebtorRoutingNumber(...)
     *   ->withExpiresAt(...)
     *   ->withFulfillmentInboundRealTimePaymentsTransferID(...)
     *   ->withIdempotencyKey(...)
     *   ->withRefusal(...)
     *   ->withRejection(...)
     *   ->withRequestedExecutionAt(...)
     *   ->withStatus(...)
     *   ->withSubmission(...)
     *   ->withType(...)
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
     * @param Cancellation|CancellationShape|null $cancellation
     * @param Currency|value-of<Currency> $currency
     * @param Debtor|DebtorShape $debtor
     * @param Refusal|RefusalShape|null $refusal
     * @param Rejection|RejectionShape|null $rejection
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumberID,
        int $amount,
        Cancellation|array|null $cancellation,
        \DateTimeInterface $createdAt,
        string $creditorName,
        Currency|string $currency,
        Debtor|array $debtor,
        string $debtorAccountNumber,
        string $debtorRoutingNumber,
        \DateTimeInterface $expiresAt,
        ?string $fulfillmentInboundRealTimePaymentsTransferID,
        ?string $idempotencyKey,
        Refusal|array|null $refusal,
        Rejection|array|null $rejection,
        ?\DateTimeInterface $requestedExecutionAt,
        Status|string $status,
        Submission|array|null $submission,
        Type|string $type,
        string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['cancellation'] = $cancellation;
        $self['createdAt'] = $createdAt;
        $self['creditorName'] = $creditorName;
        $self['currency'] = $currency;
        $self['debtor'] = $debtor;
        $self['debtorAccountNumber'] = $debtorAccountNumber;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        $self['expiresAt'] = $expiresAt;
        $self['fulfillmentInboundRealTimePaymentsTransferID'] = $fulfillmentInboundRealTimePaymentsTransferID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['refusal'] = $refusal;
        $self['rejection'] = $rejection;
        $self['requestedExecutionAt'] = $requestedExecutionAt;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['type'] = $type;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The Real-Time Payments Request for Payment's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account in which a successful transfer will arrive.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Account Number in which a successful transfer will arrive.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

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
     * If a cancellation has been requested, this will contain supplemental details. The request for payment moves to `canceled` once the recipient bank acknowledges the cancellation.
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the request for payment was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The name of the creditor requesting the payment.
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
     * Details of the person being requested to pay.
     *
     * @param Debtor|DebtorShape $debtor
     */
    public function withDebtor(Debtor|array $debtor): self
    {
        $self = clone $this;
        $self['debtor'] = $debtor;

        return $self;
    }

    /**
     * The debtor's account number, which the request is sent to.
     */
    public function withDebtorAccountNumber(string $debtorAccountNumber): self
    {
        $self = clone $this;
        $self['debtorAccountNumber'] = $debtorAccountNumber;

        return $self;
    }

    /**
     * The debtor's American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withDebtorRoutingNumber(string $debtorRoutingNumber): self
    {
        $self = clone $this;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid. After this time the debtor's bank should no longer allow the debtor to pay it.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The identifier of the Inbound Real-Time Payments Transfer that fulfilled this request.
     */
    public function withFulfillmentInboundRealTimePaymentsTransferID(
        ?string $fulfillmentInboundRealTimePaymentsTransferID
    ): self {
        $self = clone $this;
        $self['fulfillmentInboundRealTimePaymentsTransferID'] = $fulfillmentInboundRealTimePaymentsTransferID;

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
     * If the request for payment is refused by the destination financial institution or the receiving customer, this will contain supplemental details.
     *
     * @param Refusal|RefusalShape|null $refusal
     */
    public function withRefusal(Refusal|array|null $refusal): self
    {
        $self = clone $this;
        $self['refusal'] = $refusal;

        return $self;
    }

    /**
     * If the request for payment is rejected by Real-Time Payments or the destination financial institution, this will contain supplemental details.
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which the payment was requested to be made.
     */
    public function withRequestedExecutionAt(
        ?\DateTimeInterface $requestedExecutionAt
    ): self {
        $self = clone $this;
        $self['requestedExecutionAt'] = $requestedExecutionAt;

        return $self;
    }

    /**
     * The lifecycle status of the request for payment.
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
     * After the request for payment is submitted to Real-Time Payments, this will contain supplemental details.
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
     * A constant representing the object's type. For this resource it will always be `real_time_payments_request_for_payment`.
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

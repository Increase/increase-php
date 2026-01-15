<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireDrawdownRequests\WireDrawdownRequest\CreditorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequest\DebtorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequest\Status;
use Increase\WireDrawdownRequests\WireDrawdownRequest\Submission;
use Increase\WireDrawdownRequests\WireDrawdownRequest\Type;

/**
 * Wire drawdown requests enable you to request that someone else send you a wire. Because there is nuance to making sure your counterparty's bank processes these correctly, we ask that you reach out to [support@increase.com](mailto:support@increase.com) to enable this feature so we can help you plan your integration. For more information, see our [Wire Drawdown Requests documentation](/documentation/wire-drawdown-requests).
 *
 * @phpstan-import-type CreditorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequest\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequest\DebtorAddress
 * @phpstan-import-type SubmissionShape from \Increase\WireDrawdownRequests\WireDrawdownRequest\Submission
 *
 * @phpstan-type WireDrawdownRequestShape = array{
 *   id: string,
 *   accountNumberID: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   creditorAddress: CreditorAddress|CreditorAddressShape,
 *   creditorName: string,
 *   currency: string,
 *   debtorAccountNumber: string,
 *   debtorAddress: DebtorAddress|DebtorAddressShape,
 *   debtorExternalAccountID: string|null,
 *   debtorName: string,
 *   debtorRoutingNumber: string,
 *   fulfillmentInboundWireTransferID: string|null,
 *   idempotencyKey: string|null,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   type: Type|value-of<Type>,
 *   unstructuredRemittanceInformation: string,
 * }
 */
final class WireDrawdownRequest implements BaseModel
{
    /** @use SdkModel<WireDrawdownRequestShape> */
    use SdkModel;

    /**
     * The Wire drawdown request identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account Number to which the debtor—the recipient of this request—is being requested to send funds.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The amount being requested in cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the wire drawdown request was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the amount being requested. Will always be "USD".
     */
    #[Required]
    public string $currency;

    /**
     * The debtor's account number.
     */
    #[Required('debtor_account_number')]
    public string $debtorAccountNumber;

    /**
     * The debtor's address.
     */
    #[Required('debtor_address')]
    public DebtorAddress $debtorAddress;

    /**
     * The debtor's external account identifier.
     */
    #[Required('debtor_external_account_id')]
    public ?string $debtorExternalAccountID;

    /**
     * The debtor's name.
     */
    #[Required('debtor_name')]
    public string $debtorName;

    /**
     * The debtor's routing number.
     */
    #[Required('debtor_routing_number')]
    public string $debtorRoutingNumber;

    /**
     * If the recipient fulfills the drawdown request by sending funds, then this will be the identifier of the corresponding Transaction.
     */
    #[Required('fulfillment_inbound_wire_transfer_id')]
    public ?string $fulfillmentInboundWireTransferID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The lifecycle status of the drawdown request.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the drawdown request is submitted to Fedwire, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * A constant representing the object's type. For this resource it will always be `wire_drawdown_request`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Remittance information the debtor will see as part of the drawdown request.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * `new WireDrawdownRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WireDrawdownRequest::with(
     *   id: ...,
     *   accountNumberID: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   creditorAddress: ...,
     *   creditorName: ...,
     *   currency: ...,
     *   debtorAccountNumber: ...,
     *   debtorAddress: ...,
     *   debtorExternalAccountID: ...,
     *   debtorName: ...,
     *   debtorRoutingNumber: ...,
     *   fulfillmentInboundWireTransferID: ...,
     *   idempotencyKey: ...,
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
     * (new WireDrawdownRequest)
     *   ->withID(...)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCreditorAddress(...)
     *   ->withCreditorName(...)
     *   ->withCurrency(...)
     *   ->withDebtorAccountNumber(...)
     *   ->withDebtorAddress(...)
     *   ->withDebtorExternalAccountID(...)
     *   ->withDebtorName(...)
     *   ->withDebtorRoutingNumber(...)
     *   ->withFulfillmentInboundWireTransferID(...)
     *   ->withIdempotencyKey(...)
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
     * @param CreditorAddress|CreditorAddressShape $creditorAddress
     * @param DebtorAddress|DebtorAddressShape $debtorAddress
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountNumberID,
        int $amount,
        \DateTimeInterface $createdAt,
        CreditorAddress|array $creditorAddress,
        string $creditorName,
        string $currency,
        string $debtorAccountNumber,
        DebtorAddress|array $debtorAddress,
        ?string $debtorExternalAccountID,
        string $debtorName,
        string $debtorRoutingNumber,
        ?string $fulfillmentInboundWireTransferID,
        ?string $idempotencyKey,
        Status|string $status,
        Submission|array|null $submission,
        Type|string $type,
        string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['creditorAddress'] = $creditorAddress;
        $self['creditorName'] = $creditorName;
        $self['currency'] = $currency;
        $self['debtorAccountNumber'] = $debtorAccountNumber;
        $self['debtorAddress'] = $debtorAddress;
        $self['debtorExternalAccountID'] = $debtorExternalAccountID;
        $self['debtorName'] = $debtorName;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        $self['fulfillmentInboundWireTransferID'] = $fulfillmentInboundWireTransferID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['type'] = $type;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The Wire drawdown request identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account Number to which the debtor—the recipient of this request—is being requested to send funds.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The amount being requested in cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the wire drawdown request was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the amount being requested. Will always be "USD".
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The debtor's account number.
     */
    public function withDebtorAccountNumber(string $debtorAccountNumber): self
    {
        $self = clone $this;
        $self['debtorAccountNumber'] = $debtorAccountNumber;

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
     * The debtor's external account identifier.
     */
    public function withDebtorExternalAccountID(
        ?string $debtorExternalAccountID
    ): self {
        $self = clone $this;
        $self['debtorExternalAccountID'] = $debtorExternalAccountID;

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
     * The debtor's routing number.
     */
    public function withDebtorRoutingNumber(string $debtorRoutingNumber): self
    {
        $self = clone $this;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;

        return $self;
    }

    /**
     * If the recipient fulfills the drawdown request by sending funds, then this will be the identifier of the corresponding Transaction.
     */
    public function withFulfillmentInboundWireTransferID(
        ?string $fulfillmentInboundWireTransferID
    ): self {
        $self = clone $this;
        $self['fulfillmentInboundWireTransferID'] = $fulfillmentInboundWireTransferID;

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
     * The lifecycle status of the drawdown request.
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
     * After the drawdown request is submitted to Fedwire, this will contain supplemental details.
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
     * A constant representing the object's type. For this resource it will always be `wire_drawdown_request`.
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
     * Remittance information the debtor will see as part of the drawdown request.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsRequestsForPayment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment\Creditor;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment\Currency;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment\Type;

/**
 * An Inbound Real-Time Payments Request for Payment is a request initiated outside of Increase for one of your accounts to send a Real-Time Payments transfer.
 *
 * @phpstan-import-type CreditorShape from \Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment\Creditor
 *
 * @phpstan-type InboundRealTimePaymentsRequestForPaymentShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumberID: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   creditor: Creditor|CreditorShape,
 *   creditorAccountNumber: string,
 *   creditorRoutingNumber: string,
 *   currency: Currency|value-of<Currency>,
 *   debtorName: string,
 *   endToEndIdentification: string,
 *   expiresAt: \DateTimeInterface,
 *   fulfillmentRealTimePaymentsTransferID: string|null,
 *   invoicerIdentification: string|null,
 *   paymentInformationIdentification: string,
 *   requestedExecutionAt: \DateTimeInterface|null,
 *   type: Type|value-of<Type>,
 *   unstructuredRemittanceInformation: string|null,
 * }
 */
final class InboundRealTimePaymentsRequestForPayment implements BaseModel
{
    /** @use SdkModel<InboundRealTimePaymentsRequestForPaymentShape> */
    use SdkModel;

    /**
     * The inbound Real-Time Payments request for payment's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account the request for payment is for.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The identifier of the Account Number the request for payment is for.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The requested amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the request for payment was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Details of the party requesting payment.
     */
    #[Required]
    public Creditor $creditor;

    /**
     * The creditor's account number.
     */
    #[Required('creditor_account_number')]
    public string $creditorAccountNumber;

    /**
     * The creditor's American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('creditor_routing_number')]
    public string $creditorRoutingNumber;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the requested currency. This will always be "USD" for a Real-Time Payments request for payment.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The name of the account holder the payment is requested from, as provided by the creditor.
     */
    #[Required('debtor_name')]
    public string $debtorName;

    /**
     * A free-form reference string set by the creditor, to help identify the request for payment.
     */
    #[Required('end_to_end_identification')]
    public string $endToEndIdentification;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid and should no longer be paid.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * The identifier of the Real-Time Payments Transfer that fulfilled this request for payment. This is set once a transfer sent in response to the request for payment has been acknowledged by the Real-Time Payments network.
     */
    #[Required('fulfillment_real_time_payments_transfer_id')]
    public ?string $fulfillmentRealTimePaymentsTransferID;

    /**
     * An identifier for the party that issued the invoice, for requests for payment sent on behalf of another party.
     */
    #[Required('invoicer_identification')]
    public ?string $invoicerIdentification;

    /**
     * The Real-Time Payments network identification of the request for payment.
     */
    #[Required('payment_information_identification')]
    public string $paymentInformationIdentification;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which the creditor requests the payment to be made.
     */
    #[Required('requested_execution_at')]
    public ?\DateTimeInterface $requestedExecutionAt;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_real_time_payments_request_for_payment`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Unstructured information included with the request for payment.
     */
    #[Required('unstructured_remittance_information')]
    public ?string $unstructuredRemittanceInformation;

    /**
     * `new InboundRealTimePaymentsRequestForPayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundRealTimePaymentsRequestForPayment::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumberID: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   creditor: ...,
     *   creditorAccountNumber: ...,
     *   creditorRoutingNumber: ...,
     *   currency: ...,
     *   debtorName: ...,
     *   endToEndIdentification: ...,
     *   expiresAt: ...,
     *   fulfillmentRealTimePaymentsTransferID: ...,
     *   invoicerIdentification: ...,
     *   paymentInformationIdentification: ...,
     *   requestedExecutionAt: ...,
     *   type: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundRealTimePaymentsRequestForPayment)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCreditor(...)
     *   ->withCreditorAccountNumber(...)
     *   ->withCreditorRoutingNumber(...)
     *   ->withCurrency(...)
     *   ->withDebtorName(...)
     *   ->withEndToEndIdentification(...)
     *   ->withExpiresAt(...)
     *   ->withFulfillmentRealTimePaymentsTransferID(...)
     *   ->withInvoicerIdentification(...)
     *   ->withPaymentInformationIdentification(...)
     *   ->withRequestedExecutionAt(...)
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
     * @param Creditor|CreditorShape $creditor
     * @param Currency|value-of<Currency> $currency
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumberID,
        int $amount,
        \DateTimeInterface $createdAt,
        Creditor|array $creditor,
        string $creditorAccountNumber,
        string $creditorRoutingNumber,
        Currency|string $currency,
        string $debtorName,
        string $endToEndIdentification,
        \DateTimeInterface $expiresAt,
        ?string $fulfillmentRealTimePaymentsTransferID,
        ?string $invoicerIdentification,
        string $paymentInformationIdentification,
        ?\DateTimeInterface $requestedExecutionAt,
        Type|string $type,
        ?string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['creditor'] = $creditor;
        $self['creditorAccountNumber'] = $creditorAccountNumber;
        $self['creditorRoutingNumber'] = $creditorRoutingNumber;
        $self['currency'] = $currency;
        $self['debtorName'] = $debtorName;
        $self['endToEndIdentification'] = $endToEndIdentification;
        $self['expiresAt'] = $expiresAt;
        $self['fulfillmentRealTimePaymentsTransferID'] = $fulfillmentRealTimePaymentsTransferID;
        $self['invoicerIdentification'] = $invoicerIdentification;
        $self['paymentInformationIdentification'] = $paymentInformationIdentification;
        $self['requestedExecutionAt'] = $requestedExecutionAt;
        $self['type'] = $type;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The inbound Real-Time Payments request for payment's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account the request for payment is for.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The identifier of the Account Number the request for payment is for.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The requested amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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
     * Details of the party requesting payment.
     *
     * @param Creditor|CreditorShape $creditor
     */
    public function withCreditor(Creditor|array $creditor): self
    {
        $self = clone $this;
        $self['creditor'] = $creditor;

        return $self;
    }

    /**
     * The creditor's account number.
     */
    public function withCreditorAccountNumber(
        string $creditorAccountNumber
    ): self {
        $self = clone $this;
        $self['creditorAccountNumber'] = $creditorAccountNumber;

        return $self;
    }

    /**
     * The creditor's American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withCreditorRoutingNumber(
        string $creditorRoutingNumber
    ): self {
        $self = clone $this;
        $self['creditorRoutingNumber'] = $creditorRoutingNumber;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the requested currency. This will always be "USD" for a Real-Time Payments request for payment.
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
     * The name of the account holder the payment is requested from, as provided by the creditor.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

        return $self;
    }

    /**
     * A free-form reference string set by the creditor, to help identify the request for payment.
     */
    public function withEndToEndIdentification(
        string $endToEndIdentification
    ): self {
        $self = clone $this;
        $self['endToEndIdentification'] = $endToEndIdentification;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid and should no longer be paid.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The identifier of the Real-Time Payments Transfer that fulfilled this request for payment. This is set once a transfer sent in response to the request for payment has been acknowledged by the Real-Time Payments network.
     */
    public function withFulfillmentRealTimePaymentsTransferID(
        ?string $fulfillmentRealTimePaymentsTransferID
    ): self {
        $self = clone $this;
        $self['fulfillmentRealTimePaymentsTransferID'] = $fulfillmentRealTimePaymentsTransferID;

        return $self;
    }

    /**
     * An identifier for the party that issued the invoice, for requests for payment sent on behalf of another party.
     */
    public function withInvoicerIdentification(
        ?string $invoicerIdentification
    ): self {
        $self = clone $this;
        $self['invoicerIdentification'] = $invoicerIdentification;

        return $self;
    }

    /**
     * The Real-Time Payments network identification of the request for payment.
     */
    public function withPaymentInformationIdentification(
        string $paymentInformationIdentification
    ): self {
        $self = clone $this;
        $self['paymentInformationIdentification'] = $paymentInformationIdentification;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which the creditor requests the payment to be made.
     */
    public function withRequestedExecutionAt(
        ?\DateTimeInterface $requestedExecutionAt
    ): self {
        $self = clone $this;
        $self['requestedExecutionAt'] = $requestedExecutionAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_real_time_payments_request_for_payment`.
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
     * Unstructured information included with the request for payment.
     */
    public function withUnstructuredRemittanceInformation(
        ?string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

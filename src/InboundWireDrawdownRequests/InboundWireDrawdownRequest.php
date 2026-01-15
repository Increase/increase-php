<?php

declare(strict_types=1);

namespace Increase\InboundWireDrawdownRequests;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest\Type;

/**
 * Inbound wire drawdown requests are requests from someone else to send them a wire. For more information, see our [Wire Drawdown Requests documentation](/documentation/wire-drawdown-requests).
 *
 * @phpstan-type InboundWireDrawdownRequestShape = array{
 *   id: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   creditorAccountNumber: string,
 *   creditorAddressLine1: string|null,
 *   creditorAddressLine2: string|null,
 *   creditorAddressLine3: string|null,
 *   creditorName: string|null,
 *   creditorRoutingNumber: string,
 *   currency: string,
 *   debtorAddressLine1: string|null,
 *   debtorAddressLine2: string|null,
 *   debtorAddressLine3: string|null,
 *   debtorName: string|null,
 *   endToEndIdentification: string|null,
 *   inputMessageAccountabilityData: string|null,
 *   instructionIdentification: string|null,
 *   recipientAccountNumberID: string,
 *   type: Type|value-of<Type>,
 *   uniqueEndToEndTransactionReference: string|null,
 *   unstructuredRemittanceInformation: string|null,
 * }
 */
final class InboundWireDrawdownRequest implements BaseModel
{
    /** @use SdkModel<InboundWireDrawdownRequestShape> */
    use SdkModel;

    /**
     * The Wire drawdown request identifier.
     */
    #[Required]
    public string $id;

    /**
     * The amount being requested in cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the inbound wire drawdown requested was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The creditor's account number.
     */
    #[Required('creditor_account_number')]
    public string $creditorAccountNumber;

    /**
     * A free-form address field set by the sender.
     */
    #[Required('creditor_address_line1')]
    public ?string $creditorAddressLine1;

    /**
     * A free-form address field set by the sender.
     */
    #[Required('creditor_address_line2')]
    public ?string $creditorAddressLine2;

    /**
     * A free-form address field set by the sender.
     */
    #[Required('creditor_address_line3')]
    public ?string $creditorAddressLine3;

    /**
     * A name set by the sender.
     */
    #[Required('creditor_name')]
    public ?string $creditorName;

    /**
     * The creditor's routing number.
     */
    #[Required('creditor_routing_number')]
    public string $creditorRoutingNumber;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the amount being requested. Will always be "USD".
     */
    #[Required]
    public string $currency;

    /**
     * A free-form address field set by the sender.
     */
    #[Required('debtor_address_line1')]
    public ?string $debtorAddressLine1;

    /**
     * A free-form address field set by the sender.
     */
    #[Required('debtor_address_line2')]
    public ?string $debtorAddressLine2;

    /**
     * A free-form address field set by the sender.
     */
    #[Required('debtor_address_line3')]
    public ?string $debtorAddressLine3;

    /**
     * A name set by the sender.
     */
    #[Required('debtor_name')]
    public ?string $debtorName;

    /**
     * A free-form reference string set by the sender, to help identify the drawdown request.
     */
    #[Required('end_to_end_identification')]
    public ?string $endToEndIdentification;

    /**
     * A unique identifier available to the originating and receiving banks, commonly abbreviated as IMAD. It is created when the wire is submitted to the Fedwire service and is helpful when debugging wires with the originating bank.
     */
    #[Required('input_message_accountability_data')]
    public ?string $inputMessageAccountabilityData;

    /**
     * The sending bank's identifier for the drawdown request.
     */
    #[Required('instruction_identification')]
    public ?string $instructionIdentification;

    /**
     * The Account Number from which the recipient of this request is being requested to send funds.
     */
    #[Required('recipient_account_number_id')]
    public string $recipientAccountNumberID;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_wire_drawdown_request`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the drawdown request.
     */
    #[Required('unique_end_to_end_transaction_reference')]
    public ?string $uniqueEndToEndTransactionReference;

    /**
     * A free-form message set by the sender.
     */
    #[Required('unstructured_remittance_information')]
    public ?string $unstructuredRemittanceInformation;

    /**
     * `new InboundWireDrawdownRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireDrawdownRequest::with(
     *   id: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   creditorAccountNumber: ...,
     *   creditorAddressLine1: ...,
     *   creditorAddressLine2: ...,
     *   creditorAddressLine3: ...,
     *   creditorName: ...,
     *   creditorRoutingNumber: ...,
     *   currency: ...,
     *   debtorAddressLine1: ...,
     *   debtorAddressLine2: ...,
     *   debtorAddressLine3: ...,
     *   debtorName: ...,
     *   endToEndIdentification: ...,
     *   inputMessageAccountabilityData: ...,
     *   instructionIdentification: ...,
     *   recipientAccountNumberID: ...,
     *   type: ...,
     *   uniqueEndToEndTransactionReference: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireDrawdownRequest)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCreditorAccountNumber(...)
     *   ->withCreditorAddressLine1(...)
     *   ->withCreditorAddressLine2(...)
     *   ->withCreditorAddressLine3(...)
     *   ->withCreditorName(...)
     *   ->withCreditorRoutingNumber(...)
     *   ->withCurrency(...)
     *   ->withDebtorAddressLine1(...)
     *   ->withDebtorAddressLine2(...)
     *   ->withDebtorAddressLine3(...)
     *   ->withDebtorName(...)
     *   ->withEndToEndIdentification(...)
     *   ->withInputMessageAccountabilityData(...)
     *   ->withInstructionIdentification(...)
     *   ->withRecipientAccountNumberID(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        int $amount,
        \DateTimeInterface $createdAt,
        string $creditorAccountNumber,
        ?string $creditorAddressLine1,
        ?string $creditorAddressLine2,
        ?string $creditorAddressLine3,
        ?string $creditorName,
        string $creditorRoutingNumber,
        string $currency,
        ?string $debtorAddressLine1,
        ?string $debtorAddressLine2,
        ?string $debtorAddressLine3,
        ?string $debtorName,
        ?string $endToEndIdentification,
        ?string $inputMessageAccountabilityData,
        ?string $instructionIdentification,
        string $recipientAccountNumberID,
        Type|string $type,
        ?string $uniqueEndToEndTransactionReference,
        ?string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['creditorAccountNumber'] = $creditorAccountNumber;
        $self['creditorAddressLine1'] = $creditorAddressLine1;
        $self['creditorAddressLine2'] = $creditorAddressLine2;
        $self['creditorAddressLine3'] = $creditorAddressLine3;
        $self['creditorName'] = $creditorName;
        $self['creditorRoutingNumber'] = $creditorRoutingNumber;
        $self['currency'] = $currency;
        $self['debtorAddressLine1'] = $debtorAddressLine1;
        $self['debtorAddressLine2'] = $debtorAddressLine2;
        $self['debtorAddressLine3'] = $debtorAddressLine3;
        $self['debtorName'] = $debtorName;
        $self['endToEndIdentification'] = $endToEndIdentification;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;
        $self['instructionIdentification'] = $instructionIdentification;
        $self['recipientAccountNumberID'] = $recipientAccountNumberID;
        $self['type'] = $type;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
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
     * The amount being requested in cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the inbound wire drawdown requested was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * A free-form address field set by the sender.
     */
    public function withCreditorAddressLine1(
        ?string $creditorAddressLine1
    ): self {
        $self = clone $this;
        $self['creditorAddressLine1'] = $creditorAddressLine1;

        return $self;
    }

    /**
     * A free-form address field set by the sender.
     */
    public function withCreditorAddressLine2(
        ?string $creditorAddressLine2
    ): self {
        $self = clone $this;
        $self['creditorAddressLine2'] = $creditorAddressLine2;

        return $self;
    }

    /**
     * A free-form address field set by the sender.
     */
    public function withCreditorAddressLine3(
        ?string $creditorAddressLine3
    ): self {
        $self = clone $this;
        $self['creditorAddressLine3'] = $creditorAddressLine3;

        return $self;
    }

    /**
     * A name set by the sender.
     */
    public function withCreditorName(?string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The creditor's routing number.
     */
    public function withCreditorRoutingNumber(
        string $creditorRoutingNumber
    ): self {
        $self = clone $this;
        $self['creditorRoutingNumber'] = $creditorRoutingNumber;

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
     * A free-form address field set by the sender.
     */
    public function withDebtorAddressLine1(?string $debtorAddressLine1): self
    {
        $self = clone $this;
        $self['debtorAddressLine1'] = $debtorAddressLine1;

        return $self;
    }

    /**
     * A free-form address field set by the sender.
     */
    public function withDebtorAddressLine2(?string $debtorAddressLine2): self
    {
        $self = clone $this;
        $self['debtorAddressLine2'] = $debtorAddressLine2;

        return $self;
    }

    /**
     * A free-form address field set by the sender.
     */
    public function withDebtorAddressLine3(?string $debtorAddressLine3): self
    {
        $self = clone $this;
        $self['debtorAddressLine3'] = $debtorAddressLine3;

        return $self;
    }

    /**
     * A name set by the sender.
     */
    public function withDebtorName(?string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

        return $self;
    }

    /**
     * A free-form reference string set by the sender, to help identify the drawdown request.
     */
    public function withEndToEndIdentification(
        ?string $endToEndIdentification
    ): self {
        $self = clone $this;
        $self['endToEndIdentification'] = $endToEndIdentification;

        return $self;
    }

    /**
     * A unique identifier available to the originating and receiving banks, commonly abbreviated as IMAD. It is created when the wire is submitted to the Fedwire service and is helpful when debugging wires with the originating bank.
     */
    public function withInputMessageAccountabilityData(
        ?string $inputMessageAccountabilityData
    ): self {
        $self = clone $this;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;

        return $self;
    }

    /**
     * The sending bank's identifier for the drawdown request.
     */
    public function withInstructionIdentification(
        ?string $instructionIdentification
    ): self {
        $self = clone $this;
        $self['instructionIdentification'] = $instructionIdentification;

        return $self;
    }

    /**
     * The Account Number from which the recipient of this request is being requested to send funds.
     */
    public function withRecipientAccountNumberID(
        string $recipientAccountNumberID
    ): self {
        $self = clone $this;
        $self['recipientAccountNumberID'] = $recipientAccountNumberID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_wire_drawdown_request`.
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
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the drawdown request.
     */
    public function withUniqueEndToEndTransactionReference(
        ?string $uniqueEndToEndTransactionReference
    ): self {
        $self = clone $this;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;

        return $self;
    }

    /**
     * A free-form message set by the sender.
     */
    public function withUnstructuredRemittanceInformation(
        ?string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

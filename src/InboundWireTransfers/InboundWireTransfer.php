<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundWireTransfers\InboundWireTransfer\Acceptance;
use Increase\InboundWireTransfers\InboundWireTransfer\Reversal;
use Increase\InboundWireTransfers\InboundWireTransfer\Status;
use Increase\InboundWireTransfers\InboundWireTransfer\Type;

/**
 * An Inbound Wire Transfer is a wire transfer initiated outside of Increase to your account.
 *
 * @phpstan-import-type AcceptanceShape from \Increase\InboundWireTransfers\InboundWireTransfer\Acceptance
 * @phpstan-import-type ReversalShape from \Increase\InboundWireTransfers\InboundWireTransfer\Reversal
 *
 * @phpstan-type InboundWireTransferShape = array{
 *   id: string,
 *   acceptance: null|Acceptance|AcceptanceShape,
 *   accountID: string,
 *   accountNumberID: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   creditorAddressLine1: string|null,
 *   creditorAddressLine2: string|null,
 *   creditorAddressLine3: string|null,
 *   creditorName: string|null,
 *   debtorAddressLine1: string|null,
 *   debtorAddressLine2: string|null,
 *   debtorAddressLine3: string|null,
 *   debtorName: string|null,
 *   description: string,
 *   endToEndIdentification: string|null,
 *   inputMessageAccountabilityData: string|null,
 *   instructingAgentRoutingNumber: string|null,
 *   instructionIdentification: string|null,
 *   reversal: null|Reversal|ReversalShape,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   uniqueEndToEndTransactionReference: string|null,
 *   unstructuredRemittanceInformation: string|null,
 *   wireDrawdownRequestID: string|null,
 * }
 */
final class InboundWireTransfer implements BaseModel
{
    /** @use SdkModel<InboundWireTransferShape> */
    use SdkModel;

    /**
     * The inbound wire transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * If the transfer is accepted, this will contain details of the acceptance.
     */
    #[Required]
    public ?Acceptance $acceptance;

    /**
     * The Account to which the transfer belongs.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The identifier of the Account Number to which this transfer was sent.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the inbound wire transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

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
     * An Increase-constructed description of the transfer.
     */
    #[Required]
    public string $description;

    /**
     * A free-form reference string set by the sender, to help identify the transfer.
     */
    #[Required('end_to_end_identification')]
    public ?string $endToEndIdentification;

    /**
     * A unique identifier available to the originating and receiving banks, commonly abbreviated as IMAD. It is created when the wire is submitted to the Fedwire service and is helpful when debugging wires with the originating bank.
     */
    #[Required('input_message_accountability_data')]
    public ?string $inputMessageAccountabilityData;

    /**
     * The American Banking Association (ABA) routing number of the bank that sent the wire.
     */
    #[Required('instructing_agent_routing_number')]
    public ?string $instructingAgentRoutingNumber;

    /**
     * The sending bank's identifier for the wire transfer.
     */
    #[Required('instruction_identification')]
    public ?string $instructionIdentification;

    /**
     * If the transfer is reversed, this will contain details of the reversal.
     */
    #[Required]
    public ?Reversal $reversal;

    /**
     * The status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_wire_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the transfer.
     */
    #[Required('unique_end_to_end_transaction_reference')]
    public ?string $uniqueEndToEndTransactionReference;

    /**
     * A free-form message set by the sender.
     */
    #[Required('unstructured_remittance_information')]
    public ?string $unstructuredRemittanceInformation;

    /**
     * The wire drawdown request the inbound wire transfer is fulfilling.
     */
    #[Required('wire_drawdown_request_id')]
    public ?string $wireDrawdownRequestID;

    /**
     * `new InboundWireTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireTransfer::with(
     *   id: ...,
     *   acceptance: ...,
     *   accountID: ...,
     *   accountNumberID: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   creditorAddressLine1: ...,
     *   creditorAddressLine2: ...,
     *   creditorAddressLine3: ...,
     *   creditorName: ...,
     *   debtorAddressLine1: ...,
     *   debtorAddressLine2: ...,
     *   debtorAddressLine3: ...,
     *   debtorName: ...,
     *   description: ...,
     *   endToEndIdentification: ...,
     *   inputMessageAccountabilityData: ...,
     *   instructingAgentRoutingNumber: ...,
     *   instructionIdentification: ...,
     *   reversal: ...,
     *   status: ...,
     *   type: ...,
     *   uniqueEndToEndTransactionReference: ...,
     *   unstructuredRemittanceInformation: ...,
     *   wireDrawdownRequestID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireTransfer)
     *   ->withID(...)
     *   ->withAcceptance(...)
     *   ->withAccountID(...)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCreditorAddressLine1(...)
     *   ->withCreditorAddressLine2(...)
     *   ->withCreditorAddressLine3(...)
     *   ->withCreditorName(...)
     *   ->withDebtorAddressLine1(...)
     *   ->withDebtorAddressLine2(...)
     *   ->withDebtorAddressLine3(...)
     *   ->withDebtorName(...)
     *   ->withDescription(...)
     *   ->withEndToEndIdentification(...)
     *   ->withInputMessageAccountabilityData(...)
     *   ->withInstructingAgentRoutingNumber(...)
     *   ->withInstructionIdentification(...)
     *   ->withReversal(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withUniqueEndToEndTransactionReference(...)
     *   ->withUnstructuredRemittanceInformation(...)
     *   ->withWireDrawdownRequestID(...)
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
     * @param Acceptance|AcceptanceShape|null $acceptance
     * @param Reversal|ReversalShape|null $reversal
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Acceptance|array|null $acceptance,
        string $accountID,
        string $accountNumberID,
        int $amount,
        \DateTimeInterface $createdAt,
        ?string $creditorAddressLine1,
        ?string $creditorAddressLine2,
        ?string $creditorAddressLine3,
        ?string $creditorName,
        ?string $debtorAddressLine1,
        ?string $debtorAddressLine2,
        ?string $debtorAddressLine3,
        ?string $debtorName,
        string $description,
        ?string $endToEndIdentification,
        ?string $inputMessageAccountabilityData,
        ?string $instructingAgentRoutingNumber,
        ?string $instructionIdentification,
        Reversal|array|null $reversal,
        Status|string $status,
        Type|string $type,
        ?string $uniqueEndToEndTransactionReference,
        ?string $unstructuredRemittanceInformation,
        ?string $wireDrawdownRequestID,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['acceptance'] = $acceptance;
        $self['accountID'] = $accountID;
        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['creditorAddressLine1'] = $creditorAddressLine1;
        $self['creditorAddressLine2'] = $creditorAddressLine2;
        $self['creditorAddressLine3'] = $creditorAddressLine3;
        $self['creditorName'] = $creditorName;
        $self['debtorAddressLine1'] = $debtorAddressLine1;
        $self['debtorAddressLine2'] = $debtorAddressLine2;
        $self['debtorAddressLine3'] = $debtorAddressLine3;
        $self['debtorName'] = $debtorName;
        $self['description'] = $description;
        $self['endToEndIdentification'] = $endToEndIdentification;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;
        $self['instructingAgentRoutingNumber'] = $instructingAgentRoutingNumber;
        $self['instructionIdentification'] = $instructionIdentification;
        $self['reversal'] = $reversal;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;
        $self['wireDrawdownRequestID'] = $wireDrawdownRequestID;

        return $self;
    }

    /**
     * The inbound wire transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * If the transfer is accepted, this will contain details of the acceptance.
     *
     * @param Acceptance|AcceptanceShape|null $acceptance
     */
    public function withAcceptance(Acceptance|array|null $acceptance): self
    {
        $self = clone $this;
        $self['acceptance'] = $acceptance;

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
     * The identifier of the Account Number to which this transfer was sent.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the inbound wire transfer was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * An Increase-constructed description of the transfer.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * A free-form reference string set by the sender, to help identify the transfer.
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
     * The American Banking Association (ABA) routing number of the bank that sent the wire.
     */
    public function withInstructingAgentRoutingNumber(
        ?string $instructingAgentRoutingNumber
    ): self {
        $self = clone $this;
        $self['instructingAgentRoutingNumber'] = $instructingAgentRoutingNumber;

        return $self;
    }

    /**
     * The sending bank's identifier for the wire transfer.
     */
    public function withInstructionIdentification(
        ?string $instructionIdentification
    ): self {
        $self = clone $this;
        $self['instructionIdentification'] = $instructionIdentification;

        return $self;
    }

    /**
     * If the transfer is reversed, this will contain details of the reversal.
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
     * The status of the transfer.
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
     * A constant representing the object's type. For this resource it will always be `inbound_wire_transfer`.
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

    /**
     * The wire drawdown request the inbound wire transfer is fulfilling.
     */
    public function withWireDrawdownRequestID(
        ?string $wireDrawdownRequestID
    ): self {
        $self = clone $this;
        $self['wireDrawdownRequestID'] = $wireDrawdownRequestID;

        return $self;
    }
}

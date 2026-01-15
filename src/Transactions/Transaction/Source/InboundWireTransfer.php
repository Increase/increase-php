<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An Inbound Wire Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer`. An Inbound Wire Transfer Intention is created when a wire transfer is initiated at another bank and received by Increase.
 *
 * @phpstan-type InboundWireTransferShape = array{
 *   amount: int,
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
 *   transferID: string,
 *   uniqueEndToEndTransactionReference: string|null,
 *   unstructuredRemittanceInformation: string|null,
 * }
 */
final class InboundWireTransfer implements BaseModel
{
    /** @use SdkModel<InboundWireTransferShape> */
    use SdkModel;

    /**
     * The amount in USD cents.
     */
    #[Required]
    public int $amount;

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
     * The ID of the Inbound Wire Transfer object that resulted in this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

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
     * `new InboundWireTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireTransfer::with(
     *   amount: ...,
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
     *   transferID: ...,
     *   uniqueEndToEndTransactionReference: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireTransfer)
     *   ->withAmount(...)
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
     *   ->withTransferID(...)
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
     */
    public static function with(
        int $amount,
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
        string $transferID,
        ?string $uniqueEndToEndTransactionReference,
        ?string $unstructuredRemittanceInformation,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
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
        $self['transferID'] = $transferID;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

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
     * The ID of the Inbound Wire Transfer object that resulted in this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

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
}

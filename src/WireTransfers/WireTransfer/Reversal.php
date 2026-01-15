<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your transfer is reversed, this will contain details of the reversal.
 *
 * @phpstan-type ReversalShape = array{
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   debtorRoutingNumber: string|null,
 *   description: string,
 *   inputCycleDate: string,
 *   inputMessageAccountabilityData: string,
 *   inputSequenceNumber: string,
 *   inputSource: string,
 *   instructionIdentification: string|null,
 *   returnReasonAdditionalInformation: string|null,
 *   returnReasonCode: string|null,
 *   returnReasonCodeDescription: string|null,
 *   transactionID: string,
 *   wireTransferID: string,
 * }
 */
final class Reversal implements BaseModel
{
    /** @use SdkModel<ReversalShape> */
    use SdkModel;

    /**
     * The amount that was reversed in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the reversal was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The debtor's routing number.
     */
    #[Required('debtor_routing_number')]
    public ?string $debtorRoutingNumber;

    /**
     * The description on the reversal message from Fedwire, set by the reversing bank.
     */
    #[Required]
    public string $description;

    /**
     * The Fedwire cycle date for the wire reversal. The "Fedwire day" begins at 9:00 PM Eastern Time on the evening before the `cycle date`.
     */
    #[Required('input_cycle_date')]
    public string $inputCycleDate;

    /**
     * The Fedwire transaction identifier.
     */
    #[Required('input_message_accountability_data')]
    public string $inputMessageAccountabilityData;

    /**
     * The Fedwire sequence number.
     */
    #[Required('input_sequence_number')]
    public string $inputSequenceNumber;

    /**
     * The Fedwire input source identifier.
     */
    #[Required('input_source')]
    public string $inputSource;

    /**
     * The sending bank's identifier for the reversal.
     */
    #[Required('instruction_identification')]
    public ?string $instructionIdentification;

    /**
     * Additional information about the reason for the reversal.
     */
    #[Required('return_reason_additional_information')]
    public ?string $returnReasonAdditionalInformation;

    /**
     * A code provided by the sending bank giving a reason for the reversal. The common return reason codes are [documented here](/documentation/wire-reversals#reversal-reason-codes).
     */
    #[Required('return_reason_code')]
    public ?string $returnReasonCode;

    /**
     * An Increase-generated description of the `return_reason_code`.
     */
    #[Required('return_reason_code_description')]
    public ?string $returnReasonCodeDescription;

    /**
     * The ID for the Transaction associated with the transfer reversal.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * The ID for the Wire Transfer that is being reversed.
     */
    #[Required('wire_transfer_id')]
    public string $wireTransferID;

    /**
     * `new Reversal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reversal::with(
     *   amount: ...,
     *   createdAt: ...,
     *   debtorRoutingNumber: ...,
     *   description: ...,
     *   inputCycleDate: ...,
     *   inputMessageAccountabilityData: ...,
     *   inputSequenceNumber: ...,
     *   inputSource: ...,
     *   instructionIdentification: ...,
     *   returnReasonAdditionalInformation: ...,
     *   returnReasonCode: ...,
     *   returnReasonCodeDescription: ...,
     *   transactionID: ...,
     *   wireTransferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reversal)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withDebtorRoutingNumber(...)
     *   ->withDescription(...)
     *   ->withInputCycleDate(...)
     *   ->withInputMessageAccountabilityData(...)
     *   ->withInputSequenceNumber(...)
     *   ->withInputSource(...)
     *   ->withInstructionIdentification(...)
     *   ->withReturnReasonAdditionalInformation(...)
     *   ->withReturnReasonCode(...)
     *   ->withReturnReasonCodeDescription(...)
     *   ->withTransactionID(...)
     *   ->withWireTransferID(...)
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
        \DateTimeInterface $createdAt,
        ?string $debtorRoutingNumber,
        string $description,
        string $inputCycleDate,
        string $inputMessageAccountabilityData,
        string $inputSequenceNumber,
        string $inputSource,
        ?string $instructionIdentification,
        ?string $returnReasonAdditionalInformation,
        ?string $returnReasonCode,
        ?string $returnReasonCodeDescription,
        string $transactionID,
        string $wireTransferID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        $self['description'] = $description;
        $self['inputCycleDate'] = $inputCycleDate;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;
        $self['inputSequenceNumber'] = $inputSequenceNumber;
        $self['inputSource'] = $inputSource;
        $self['instructionIdentification'] = $instructionIdentification;
        $self['returnReasonAdditionalInformation'] = $returnReasonAdditionalInformation;
        $self['returnReasonCode'] = $returnReasonCode;
        $self['returnReasonCodeDescription'] = $returnReasonCodeDescription;
        $self['transactionID'] = $transactionID;
        $self['wireTransferID'] = $wireTransferID;

        return $self;
    }

    /**
     * The amount that was reversed in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the reversal was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The debtor's routing number.
     */
    public function withDebtorRoutingNumber(?string $debtorRoutingNumber): self
    {
        $self = clone $this;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;

        return $self;
    }

    /**
     * The description on the reversal message from Fedwire, set by the reversing bank.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The Fedwire cycle date for the wire reversal. The "Fedwire day" begins at 9:00 PM Eastern Time on the evening before the `cycle date`.
     */
    public function withInputCycleDate(string $inputCycleDate): self
    {
        $self = clone $this;
        $self['inputCycleDate'] = $inputCycleDate;

        return $self;
    }

    /**
     * The Fedwire transaction identifier.
     */
    public function withInputMessageAccountabilityData(
        string $inputMessageAccountabilityData
    ): self {
        $self = clone $this;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;

        return $self;
    }

    /**
     * The Fedwire sequence number.
     */
    public function withInputSequenceNumber(string $inputSequenceNumber): self
    {
        $self = clone $this;
        $self['inputSequenceNumber'] = $inputSequenceNumber;

        return $self;
    }

    /**
     * The Fedwire input source identifier.
     */
    public function withInputSource(string $inputSource): self
    {
        $self = clone $this;
        $self['inputSource'] = $inputSource;

        return $self;
    }

    /**
     * The sending bank's identifier for the reversal.
     */
    public function withInstructionIdentification(
        ?string $instructionIdentification
    ): self {
        $self = clone $this;
        $self['instructionIdentification'] = $instructionIdentification;

        return $self;
    }

    /**
     * Additional information about the reason for the reversal.
     */
    public function withReturnReasonAdditionalInformation(
        ?string $returnReasonAdditionalInformation
    ): self {
        $self = clone $this;
        $self['returnReasonAdditionalInformation'] = $returnReasonAdditionalInformation;

        return $self;
    }

    /**
     * A code provided by the sending bank giving a reason for the reversal. The common return reason codes are [documented here](/documentation/wire-reversals#reversal-reason-codes).
     */
    public function withReturnReasonCode(?string $returnReasonCode): self
    {
        $self = clone $this;
        $self['returnReasonCode'] = $returnReasonCode;

        return $self;
    }

    /**
     * An Increase-generated description of the `return_reason_code`.
     */
    public function withReturnReasonCodeDescription(
        ?string $returnReasonCodeDescription
    ): self {
        $self = clone $this;
        $self['returnReasonCodeDescription'] = $returnReasonCodeDescription;

        return $self;
    }

    /**
     * The ID for the Transaction associated with the transfer reversal.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The ID for the Wire Transfer that is being reversed.
     */
    public function withWireTransferID(string $wireTransferID): self
    {
        $self = clone $this;
        $self['wireTransferID'] = $wireTransferID;

        return $self;
    }
}

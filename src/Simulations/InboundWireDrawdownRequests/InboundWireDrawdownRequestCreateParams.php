<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundWireDrawdownRequests;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates receiving an [Inbound Wire Drawdown Request](#inbound-wire-drawdown-requests).
 *
 * @see Increase\Services\Simulations\InboundWireDrawdownRequestsService::create()
 *
 * @phpstan-type InboundWireDrawdownRequestCreateParamsShape = array{
 *   amount: int,
 *   creditorAccountNumber: string,
 *   creditorRoutingNumber: string,
 *   currency: string,
 *   recipientAccountNumberID: string,
 *   creditorAddressLine1?: string|null,
 *   creditorAddressLine2?: string|null,
 *   creditorAddressLine3?: string|null,
 *   creditorName?: string|null,
 *   debtorAccountNumber?: string|null,
 *   debtorAddressLine1?: string|null,
 *   debtorAddressLine2?: string|null,
 *   debtorAddressLine3?: string|null,
 *   debtorName?: string|null,
 *   debtorRoutingNumber?: string|null,
 *   endToEndIdentification?: string|null,
 *   instructionIdentification?: string|null,
 *   uniqueEndToEndTransactionReference?: string|null,
 *   unstructuredRemittanceInformation?: string|null,
 * }
 */
final class InboundWireDrawdownRequestCreateParams implements BaseModel
{
    /** @use SdkModel<InboundWireDrawdownRequestCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount being requested in cents.
     */
    #[Required]
    public int $amount;

    /**
     * The creditor's account number.
     */
    #[Required('creditor_account_number')]
    public string $creditorAccountNumber;

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
     * The Account Number to which the recipient of this request is being requested to send funds from.
     */
    #[Required('recipient_account_number_id')]
    public string $recipientAccountNumberID;

    /**
     * A free-form address field set by the sender representing the first line of the creditor's address.
     */
    #[Optional('creditor_address_line1')]
    public ?string $creditorAddressLine1;

    /**
     * A free-form address field set by the sender representing the second line of the creditor's address.
     */
    #[Optional('creditor_address_line2')]
    public ?string $creditorAddressLine2;

    /**
     * A free-form address field set by the sender representing the third line of the creditor's address.
     */
    #[Optional('creditor_address_line3')]
    public ?string $creditorAddressLine3;

    /**
     * A free-form name field set by the sender representing the creditor's name.
     */
    #[Optional('creditor_name')]
    public ?string $creditorName;

    /**
     * The debtor's account number.
     */
    #[Optional('debtor_account_number')]
    public ?string $debtorAccountNumber;

    /**
     * A free-form address field set by the sender representing the first line of the debtor's address.
     */
    #[Optional('debtor_address_line1')]
    public ?string $debtorAddressLine1;

    /**
     * A free-form address field set by the sender representing the second line of the debtor's address.
     */
    #[Optional('debtor_address_line2')]
    public ?string $debtorAddressLine2;

    /**
     * A free-form address field set by the sender.
     */
    #[Optional('debtor_address_line3')]
    public ?string $debtorAddressLine3;

    /**
     * A free-form name field set by the sender representing the debtor's name.
     */
    #[Optional('debtor_name')]
    public ?string $debtorName;

    /**
     * The debtor's routing number.
     */
    #[Optional('debtor_routing_number')]
    public ?string $debtorRoutingNumber;

    /**
     * A free-form reference string set by the sender, to help identify the transfer.
     */
    #[Optional('end_to_end_identification')]
    public ?string $endToEndIdentification;

    /**
     * The sending bank's identifier for the wire transfer.
     */
    #[Optional('instruction_identification')]
    public ?string $instructionIdentification;

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the transfer.
     */
    #[Optional('unique_end_to_end_transaction_reference')]
    public ?string $uniqueEndToEndTransactionReference;

    /**
     * A free-form message set by the sender.
     */
    #[Optional('unstructured_remittance_information')]
    public ?string $unstructuredRemittanceInformation;

    /**
     * `new InboundWireDrawdownRequestCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireDrawdownRequestCreateParams::with(
     *   amount: ...,
     *   creditorAccountNumber: ...,
     *   creditorRoutingNumber: ...,
     *   currency: ...,
     *   recipientAccountNumberID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireDrawdownRequestCreateParams)
     *   ->withAmount(...)
     *   ->withCreditorAccountNumber(...)
     *   ->withCreditorRoutingNumber(...)
     *   ->withCurrency(...)
     *   ->withRecipientAccountNumberID(...)
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
        string $creditorAccountNumber,
        string $creditorRoutingNumber,
        string $currency,
        string $recipientAccountNumberID,
        ?string $creditorAddressLine1 = null,
        ?string $creditorAddressLine2 = null,
        ?string $creditorAddressLine3 = null,
        ?string $creditorName = null,
        ?string $debtorAccountNumber = null,
        ?string $debtorAddressLine1 = null,
        ?string $debtorAddressLine2 = null,
        ?string $debtorAddressLine3 = null,
        ?string $debtorName = null,
        ?string $debtorRoutingNumber = null,
        ?string $endToEndIdentification = null,
        ?string $instructionIdentification = null,
        ?string $uniqueEndToEndTransactionReference = null,
        ?string $unstructuredRemittanceInformation = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['creditorAccountNumber'] = $creditorAccountNumber;
        $self['creditorRoutingNumber'] = $creditorRoutingNumber;
        $self['currency'] = $currency;
        $self['recipientAccountNumberID'] = $recipientAccountNumberID;

        null !== $creditorAddressLine1 && $self['creditorAddressLine1'] = $creditorAddressLine1;
        null !== $creditorAddressLine2 && $self['creditorAddressLine2'] = $creditorAddressLine2;
        null !== $creditorAddressLine3 && $self['creditorAddressLine3'] = $creditorAddressLine3;
        null !== $creditorName && $self['creditorName'] = $creditorName;
        null !== $debtorAccountNumber && $self['debtorAccountNumber'] = $debtorAccountNumber;
        null !== $debtorAddressLine1 && $self['debtorAddressLine1'] = $debtorAddressLine1;
        null !== $debtorAddressLine2 && $self['debtorAddressLine2'] = $debtorAddressLine2;
        null !== $debtorAddressLine3 && $self['debtorAddressLine3'] = $debtorAddressLine3;
        null !== $debtorName && $self['debtorName'] = $debtorName;
        null !== $debtorRoutingNumber && $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        null !== $endToEndIdentification && $self['endToEndIdentification'] = $endToEndIdentification;
        null !== $instructionIdentification && $self['instructionIdentification'] = $instructionIdentification;
        null !== $uniqueEndToEndTransactionReference && $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
        null !== $unstructuredRemittanceInformation && $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

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
     * The Account Number to which the recipient of this request is being requested to send funds from.
     */
    public function withRecipientAccountNumberID(
        string $recipientAccountNumberID
    ): self {
        $self = clone $this;
        $self['recipientAccountNumberID'] = $recipientAccountNumberID;

        return $self;
    }

    /**
     * A free-form address field set by the sender representing the first line of the creditor's address.
     */
    public function withCreditorAddressLine1(string $creditorAddressLine1): self
    {
        $self = clone $this;
        $self['creditorAddressLine1'] = $creditorAddressLine1;

        return $self;
    }

    /**
     * A free-form address field set by the sender representing the second line of the creditor's address.
     */
    public function withCreditorAddressLine2(string $creditorAddressLine2): self
    {
        $self = clone $this;
        $self['creditorAddressLine2'] = $creditorAddressLine2;

        return $self;
    }

    /**
     * A free-form address field set by the sender representing the third line of the creditor's address.
     */
    public function withCreditorAddressLine3(string $creditorAddressLine3): self
    {
        $self = clone $this;
        $self['creditorAddressLine3'] = $creditorAddressLine3;

        return $self;
    }

    /**
     * A free-form name field set by the sender representing the creditor's name.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

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
     * A free-form address field set by the sender representing the first line of the debtor's address.
     */
    public function withDebtorAddressLine1(string $debtorAddressLine1): self
    {
        $self = clone $this;
        $self['debtorAddressLine1'] = $debtorAddressLine1;

        return $self;
    }

    /**
     * A free-form address field set by the sender representing the second line of the debtor's address.
     */
    public function withDebtorAddressLine2(string $debtorAddressLine2): self
    {
        $self = clone $this;
        $self['debtorAddressLine2'] = $debtorAddressLine2;

        return $self;
    }

    /**
     * A free-form address field set by the sender.
     */
    public function withDebtorAddressLine3(string $debtorAddressLine3): self
    {
        $self = clone $this;
        $self['debtorAddressLine3'] = $debtorAddressLine3;

        return $self;
    }

    /**
     * A free-form name field set by the sender representing the debtor's name.
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
     * A free-form reference string set by the sender, to help identify the transfer.
     */
    public function withEndToEndIdentification(
        string $endToEndIdentification
    ): self {
        $self = clone $this;
        $self['endToEndIdentification'] = $endToEndIdentification;

        return $self;
    }

    /**
     * The sending bank's identifier for the wire transfer.
     */
    public function withInstructionIdentification(
        string $instructionIdentification
    ): self {
        $self = clone $this;
        $self['instructionIdentification'] = $instructionIdentification;

        return $self;
    }

    /**
     * The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the transfer.
     */
    public function withUniqueEndToEndTransactionReference(
        string $uniqueEndToEndTransactionReference
    ): self {
        $self = clone $this;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;

        return $self;
    }

    /**
     * A free-form message set by the sender.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

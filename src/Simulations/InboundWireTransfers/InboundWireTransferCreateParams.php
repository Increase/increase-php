<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundWireTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an [Inbound Wire Transfer](#inbound-wire-transfers) to your account.
 *
 * @see Increase\Services\Simulations\InboundWireTransfersService::create()
 *
 * @phpstan-type InboundWireTransferCreateParamsShape = array{
 *   accountNumberID: string,
 *   amount: int,
 *   creditorAddressLine1?: string|null,
 *   creditorAddressLine2?: string|null,
 *   creditorAddressLine3?: string|null,
 *   creditorName?: string|null,
 *   debtorAddressLine1?: string|null,
 *   debtorAddressLine2?: string|null,
 *   debtorAddressLine3?: string|null,
 *   debtorName?: string|null,
 *   endToEndIdentification?: string|null,
 *   instructingAgentRoutingNumber?: string|null,
 *   instructionIdentification?: string|null,
 *   uniqueEndToEndTransactionReference?: string|null,
 *   unstructuredRemittanceInformation?: string|null,
 *   wireDrawdownRequestID?: string|null,
 * }
 */
final class InboundWireTransferCreateParams implements BaseModel
{
    /** @use SdkModel<InboundWireTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account Number the inbound Wire Transfer is for.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The transfer amount in cents. Must be positive.
     */
    #[Required]
    public int $amount;

    /**
     * The sending bank will set creditor_address_line1 in production. You can simulate any value here.
     */
    #[Optional('creditor_address_line1')]
    public ?string $creditorAddressLine1;

    /**
     * The sending bank will set creditor_address_line2 in production. You can simulate any value here.
     */
    #[Optional('creditor_address_line2')]
    public ?string $creditorAddressLine2;

    /**
     * The sending bank will set creditor_address_line3 in production. You can simulate any value here.
     */
    #[Optional('creditor_address_line3')]
    public ?string $creditorAddressLine3;

    /**
     * The sending bank will set creditor_name in production. You can simulate any value here.
     */
    #[Optional('creditor_name')]
    public ?string $creditorName;

    /**
     * The sending bank will set debtor_address_line1 in production. You can simulate any value here.
     */
    #[Optional('debtor_address_line1')]
    public ?string $debtorAddressLine1;

    /**
     * The sending bank will set debtor_address_line2 in production. You can simulate any value here.
     */
    #[Optional('debtor_address_line2')]
    public ?string $debtorAddressLine2;

    /**
     * The sending bank will set debtor_address_line3 in production. You can simulate any value here.
     */
    #[Optional('debtor_address_line3')]
    public ?string $debtorAddressLine3;

    /**
     * The sending bank will set debtor_name in production. You can simulate any value here.
     */
    #[Optional('debtor_name')]
    public ?string $debtorName;

    /**
     * The sending bank will set end_to_end_identification in production. You can simulate any value here.
     */
    #[Optional('end_to_end_identification')]
    public ?string $endToEndIdentification;

    /**
     * The sending bank will set instructing_agent_routing_number in production. You can simulate any value here.
     */
    #[Optional('instructing_agent_routing_number')]
    public ?string $instructingAgentRoutingNumber;

    /**
     * The sending bank will set instruction_identification in production. You can simulate any value here.
     */
    #[Optional('instruction_identification')]
    public ?string $instructionIdentification;

    /**
     * The sending bank will set unique_end_to_end_transaction_reference in production. You can simulate any value here.
     */
    #[Optional('unique_end_to_end_transaction_reference')]
    public ?string $uniqueEndToEndTransactionReference;

    /**
     * The sending bank will set unstructured_remittance_information in production. You can simulate any value here.
     */
    #[Optional('unstructured_remittance_information')]
    public ?string $unstructuredRemittanceInformation;

    /**
     * The identifier of a Wire Drawdown Request the inbound Wire Transfer is fulfilling.
     */
    #[Optional('wire_drawdown_request_id')]
    public ?string $wireDrawdownRequestID;

    /**
     * `new InboundWireTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireTransferCreateParams::with(accountNumberID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireTransferCreateParams)->withAccountNumberID(...)->withAmount(...)
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
        string $accountNumberID,
        int $amount,
        ?string $creditorAddressLine1 = null,
        ?string $creditorAddressLine2 = null,
        ?string $creditorAddressLine3 = null,
        ?string $creditorName = null,
        ?string $debtorAddressLine1 = null,
        ?string $debtorAddressLine2 = null,
        ?string $debtorAddressLine3 = null,
        ?string $debtorName = null,
        ?string $endToEndIdentification = null,
        ?string $instructingAgentRoutingNumber = null,
        ?string $instructionIdentification = null,
        ?string $uniqueEndToEndTransactionReference = null,
        ?string $unstructuredRemittanceInformation = null,
        ?string $wireDrawdownRequestID = null,
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;

        null !== $creditorAddressLine1 && $self['creditorAddressLine1'] = $creditorAddressLine1;
        null !== $creditorAddressLine2 && $self['creditorAddressLine2'] = $creditorAddressLine2;
        null !== $creditorAddressLine3 && $self['creditorAddressLine3'] = $creditorAddressLine3;
        null !== $creditorName && $self['creditorName'] = $creditorName;
        null !== $debtorAddressLine1 && $self['debtorAddressLine1'] = $debtorAddressLine1;
        null !== $debtorAddressLine2 && $self['debtorAddressLine2'] = $debtorAddressLine2;
        null !== $debtorAddressLine3 && $self['debtorAddressLine3'] = $debtorAddressLine3;
        null !== $debtorName && $self['debtorName'] = $debtorName;
        null !== $endToEndIdentification && $self['endToEndIdentification'] = $endToEndIdentification;
        null !== $instructingAgentRoutingNumber && $self['instructingAgentRoutingNumber'] = $instructingAgentRoutingNumber;
        null !== $instructionIdentification && $self['instructionIdentification'] = $instructionIdentification;
        null !== $uniqueEndToEndTransactionReference && $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;
        null !== $unstructuredRemittanceInformation && $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;
        null !== $wireDrawdownRequestID && $self['wireDrawdownRequestID'] = $wireDrawdownRequestID;

        return $self;
    }

    /**
     * The identifier of the Account Number the inbound Wire Transfer is for.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The transfer amount in cents. Must be positive.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The sending bank will set creditor_address_line1 in production. You can simulate any value here.
     */
    public function withCreditorAddressLine1(string $creditorAddressLine1): self
    {
        $self = clone $this;
        $self['creditorAddressLine1'] = $creditorAddressLine1;

        return $self;
    }

    /**
     * The sending bank will set creditor_address_line2 in production. You can simulate any value here.
     */
    public function withCreditorAddressLine2(string $creditorAddressLine2): self
    {
        $self = clone $this;
        $self['creditorAddressLine2'] = $creditorAddressLine2;

        return $self;
    }

    /**
     * The sending bank will set creditor_address_line3 in production. You can simulate any value here.
     */
    public function withCreditorAddressLine3(string $creditorAddressLine3): self
    {
        $self = clone $this;
        $self['creditorAddressLine3'] = $creditorAddressLine3;

        return $self;
    }

    /**
     * The sending bank will set creditor_name in production. You can simulate any value here.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The sending bank will set debtor_address_line1 in production. You can simulate any value here.
     */
    public function withDebtorAddressLine1(string $debtorAddressLine1): self
    {
        $self = clone $this;
        $self['debtorAddressLine1'] = $debtorAddressLine1;

        return $self;
    }

    /**
     * The sending bank will set debtor_address_line2 in production. You can simulate any value here.
     */
    public function withDebtorAddressLine2(string $debtorAddressLine2): self
    {
        $self = clone $this;
        $self['debtorAddressLine2'] = $debtorAddressLine2;

        return $self;
    }

    /**
     * The sending bank will set debtor_address_line3 in production. You can simulate any value here.
     */
    public function withDebtorAddressLine3(string $debtorAddressLine3): self
    {
        $self = clone $this;
        $self['debtorAddressLine3'] = $debtorAddressLine3;

        return $self;
    }

    /**
     * The sending bank will set debtor_name in production. You can simulate any value here.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

        return $self;
    }

    /**
     * The sending bank will set end_to_end_identification in production. You can simulate any value here.
     */
    public function withEndToEndIdentification(
        string $endToEndIdentification
    ): self {
        $self = clone $this;
        $self['endToEndIdentification'] = $endToEndIdentification;

        return $self;
    }

    /**
     * The sending bank will set instructing_agent_routing_number in production. You can simulate any value here.
     */
    public function withInstructingAgentRoutingNumber(
        string $instructingAgentRoutingNumber
    ): self {
        $self = clone $this;
        $self['instructingAgentRoutingNumber'] = $instructingAgentRoutingNumber;

        return $self;
    }

    /**
     * The sending bank will set instruction_identification in production. You can simulate any value here.
     */
    public function withInstructionIdentification(
        string $instructionIdentification
    ): self {
        $self = clone $this;
        $self['instructionIdentification'] = $instructionIdentification;

        return $self;
    }

    /**
     * The sending bank will set unique_end_to_end_transaction_reference in production. You can simulate any value here.
     */
    public function withUniqueEndToEndTransactionReference(
        string $uniqueEndToEndTransactionReference
    ): self {
        $self = clone $this;
        $self['uniqueEndToEndTransactionReference'] = $uniqueEndToEndTransactionReference;

        return $self;
    }

    /**
     * The sending bank will set unstructured_remittance_information in production. You can simulate any value here.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The identifier of a Wire Drawdown Request the inbound Wire Transfer is fulfilling.
     */
    public function withWireDrawdownRequestID(
        string $wireDrawdownRequestID
    ): self {
        $self = clone $this;
        $self['wireDrawdownRequestID'] = $wireDrawdownRequestID;

        return $self;
    }
}

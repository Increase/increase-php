<?php

declare(strict_types=1);

namespace Increase\WireTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransferCreateParams\Creditor;
use Increase\WireTransfers\WireTransferCreateParams\Debtor;
use Increase\WireTransfers\WireTransferCreateParams\Remittance;

/**
 * Create a Wire Transfer.
 *
 * @see Increase\Services\WireTransfersService::create()
 *
 * @phpstan-import-type CreditorShape from \Increase\WireTransfers\WireTransferCreateParams\Creditor
 * @phpstan-import-type RemittanceShape from \Increase\WireTransfers\WireTransferCreateParams\Remittance
 * @phpstan-import-type DebtorShape from \Increase\WireTransfers\WireTransferCreateParams\Debtor
 *
 * @phpstan-type WireTransferCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   creditor: Creditor|CreditorShape,
 *   remittance: Remittance|RemittanceShape,
 *   accountNumber?: string|null,
 *   debtor?: null|Debtor|DebtorShape,
 *   externalAccountID?: string|null,
 *   inboundWireDrawdownRequestID?: string|null,
 *   requireApproval?: bool|null,
 *   routingNumber?: string|null,
 *   sourceAccountNumberID?: string|null,
 * }
 */
final class WireTransferCreateParams implements BaseModel
{
    /** @use SdkModel<WireTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the account that will send the transfer.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The person or business that is receiving the funds from the transfer.
     */
    #[Required]
    public Creditor $creditor;

    /**
     * Additional remittance information related to the wire transfer.
     */
    #[Required]
    public Remittance $remittance;

    /**
     * The account number for the destination account.
     */
    #[Optional('account_number')]
    public ?string $accountNumber;

    /**
     * The person or business whose funds are being transferred. This is only necessary if you're transferring from a commingled account. Otherwise, we'll use the associated entity's details.
     */
    #[Optional]
    public ?Debtor $debtor;

    /**
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number` and `routing_number` must be absent.
     */
    #[Optional('external_account_id')]
    public ?string $externalAccountID;

    /**
     * The ID of an Inbound Wire Drawdown Request in response to which this transfer is being sent.
     */
    #[Optional('inbound_wire_drawdown_request_id')]
    public ?string $inboundWireDrawdownRequestID;

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    #[Optional('routing_number')]
    public ?string $routingNumber;

    /**
     * The ID of an Account Number that will be passed to the wire's recipient.
     */
    #[Optional('source_account_number_id')]
    public ?string $sourceAccountNumberID;

    /**
     * `new WireTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WireTransferCreateParams::with(
     *   accountID: ..., amount: ..., creditor: ..., remittance: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WireTransferCreateParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withCreditor(...)
     *   ->withRemittance(...)
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
     * @param Remittance|RemittanceShape $remittance
     * @param Debtor|DebtorShape|null $debtor
     */
    public static function with(
        string $accountID,
        int $amount,
        Creditor|array $creditor,
        Remittance|array $remittance,
        ?string $accountNumber = null,
        Debtor|array|null $debtor = null,
        ?string $externalAccountID = null,
        ?string $inboundWireDrawdownRequestID = null,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
        ?string $sourceAccountNumberID = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['creditor'] = $creditor;
        $self['remittance'] = $remittance;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $debtor && $self['debtor'] = $debtor;
        null !== $externalAccountID && $self['externalAccountID'] = $externalAccountID;
        null !== $inboundWireDrawdownRequestID && $self['inboundWireDrawdownRequestID'] = $inboundWireDrawdownRequestID;
        null !== $requireApproval && $self['requireApproval'] = $requireApproval;
        null !== $routingNumber && $self['routingNumber'] = $routingNumber;
        null !== $sourceAccountNumberID && $self['sourceAccountNumberID'] = $sourceAccountNumberID;

        return $self;
    }

    /**
     * The identifier for the account that will send the transfer.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * The person or business that is receiving the funds from the transfer.
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
     * Additional remittance information related to the wire transfer.
     *
     * @param Remittance|RemittanceShape $remittance
     */
    public function withRemittance(Remittance|array $remittance): self
    {
        $self = clone $this;
        $self['remittance'] = $remittance;

        return $self;
    }

    /**
     * The account number for the destination account.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The person or business whose funds are being transferred. This is only necessary if you're transferring from a commingled account. Otherwise, we'll use the associated entity's details.
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
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number` and `routing_number` must be absent.
     */
    public function withExternalAccountID(string $externalAccountID): self
    {
        $self = clone $this;
        $self['externalAccountID'] = $externalAccountID;

        return $self;
    }

    /**
     * The ID of an Inbound Wire Drawdown Request in response to which this transfer is being sent.
     */
    public function withInboundWireDrawdownRequestID(
        string $inboundWireDrawdownRequestID
    ): self {
        $self = clone $this;
        $self['inboundWireDrawdownRequestID'] = $inboundWireDrawdownRequestID;

        return $self;
    }

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    public function withRequireApproval(bool $requireApproval): self
    {
        $self = clone $this;
        $self['requireApproval'] = $requireApproval;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The ID of an Account Number that will be passed to the wire's recipient.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Real-Time Payments Transfer.
 *
 * @see Increase\Services\RealTimePaymentsTransfersService::create()
 *
 * @phpstan-type RealTimePaymentsTransferCreateParamsShape = array{
 *   amount: int,
 *   creditorName: string,
 *   sourceAccountNumberID: string,
 *   unstructuredRemittanceInformation: string,
 *   accountNumber?: string|null,
 *   debtorName?: string|null,
 *   externalAccountID?: string|null,
 *   requireApproval?: bool|null,
 *   routingNumber?: string|null,
 *   ultimateCreditorName?: string|null,
 *   ultimateDebtorName?: string|null,
 * }
 */
final class RealTimePaymentsTransferCreateParams implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The transfer amount in USD cents. For Real-Time Payments transfers, must be positive.
     */
    #[Required]
    public int $amount;

    /**
     * The name of the transfer's recipient.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The identifier of the Account Number from which to send the transfer.
     */
    #[Required('source_account_number_id')]
    public string $sourceAccountNumberID;

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * The destination account number.
     */
    #[Optional('account_number')]
    public ?string $accountNumber;

    /**
     * The name of the transfer's sender. If not provided, defaults to the name of the account's entity.
     */
    #[Optional('debtor_name')]
    public ?string $debtorName;

    /**
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number` and `routing_number` must be absent.
     */
    #[Optional('external_account_id')]
    public ?string $externalAccountID;

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * The destination American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Optional('routing_number')]
    public ?string $routingNumber;

    /**
     * The name of the ultimate recipient of the transfer. Set this if the creditor is an intermediary receiving the payment for someone else.
     */
    #[Optional('ultimate_creditor_name')]
    public ?string $ultimateCreditorName;

    /**
     * The name of the ultimate sender of the transfer. Set this if the funds are being sent on behalf of someone who is not the account holder at Increase.
     */
    #[Optional('ultimate_debtor_name')]
    public ?string $ultimateDebtorName;

    /**
     * `new RealTimePaymentsTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimePaymentsTransferCreateParams::with(
     *   amount: ...,
     *   creditorName: ...,
     *   sourceAccountNumberID: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimePaymentsTransferCreateParams)
     *   ->withAmount(...)
     *   ->withCreditorName(...)
     *   ->withSourceAccountNumberID(...)
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
        string $creditorName,
        string $sourceAccountNumberID,
        string $unstructuredRemittanceInformation,
        ?string $accountNumber = null,
        ?string $debtorName = null,
        ?string $externalAccountID = null,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
        ?string $ultimateCreditorName = null,
        ?string $ultimateDebtorName = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['creditorName'] = $creditorName;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $debtorName && $self['debtorName'] = $debtorName;
        null !== $externalAccountID && $self['externalAccountID'] = $externalAccountID;
        null !== $requireApproval && $self['requireApproval'] = $requireApproval;
        null !== $routingNumber && $self['routingNumber'] = $routingNumber;
        null !== $ultimateCreditorName && $self['ultimateCreditorName'] = $ultimateCreditorName;
        null !== $ultimateDebtorName && $self['ultimateDebtorName'] = $ultimateDebtorName;

        return $self;
    }

    /**
     * The transfer amount in USD cents. For Real-Time Payments transfers, must be positive.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The name of the transfer's recipient.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The identifier of the Account Number from which to send the transfer.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

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

    /**
     * The destination account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The name of the transfer's sender. If not provided, defaults to the name of the account's entity.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

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
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    public function withRequireApproval(bool $requireApproval): self
    {
        $self = clone $this;
        $self['requireApproval'] = $requireApproval;

        return $self;
    }

    /**
     * The destination American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The name of the ultimate recipient of the transfer. Set this if the creditor is an intermediary receiving the payment for someone else.
     */
    public function withUltimateCreditorName(string $ultimateCreditorName): self
    {
        $self = clone $this;
        $self['ultimateCreditorName'] = $ultimateCreditorName;

        return $self;
    }

    /**
     * The name of the ultimate sender of the transfer. Set this if the funds are being sent on behalf of someone who is not the account holder at Increase.
     */
    public function withUltimateDebtorName(string $ultimateDebtorName): self
    {
        $self = clone $this;
        $self['ultimateDebtorName'] = $ultimateDebtorName;

        return $self;
    }
}

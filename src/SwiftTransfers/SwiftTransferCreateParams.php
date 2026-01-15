<?php

declare(strict_types=1);

namespace Increase\SwiftTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\SwiftTransfers\SwiftTransferCreateParams\CreditorAddress;
use Increase\SwiftTransfers\SwiftTransferCreateParams\DebtorAddress;
use Increase\SwiftTransfers\SwiftTransferCreateParams\InstructedCurrency;

/**
 * Create a Swift Transfer.
 *
 * @see Increase\Services\SwiftTransfersService::create()
 *
 * @phpstan-import-type CreditorAddressShape from \Increase\SwiftTransfers\SwiftTransferCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\SwiftTransfers\SwiftTransferCreateParams\DebtorAddress
 *
 * @phpstan-type SwiftTransferCreateParamsShape = array{
 *   accountID: string,
 *   accountNumber: string,
 *   bankIdentificationCode: string,
 *   creditorAddress: CreditorAddress|CreditorAddressShape,
 *   creditorName: string,
 *   debtorAddress: DebtorAddress|DebtorAddressShape,
 *   debtorName: string,
 *   instructedAmount: int,
 *   instructedCurrency: InstructedCurrency|value-of<InstructedCurrency>,
 *   sourceAccountNumberID: string,
 *   unstructuredRemittanceInformation: string,
 *   requireApproval?: bool|null,
 *   routingNumber?: string|null,
 * }
 */
final class SwiftTransferCreateParams implements BaseModel
{
    /** @use SdkModel<SwiftTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the account that will send the transfer.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The creditor's account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The bank identification code (BIC) of the creditor. If it ends with the three-character branch code, this must be 11 characters long. Otherwise this must be 8 characters and the branch code will be assumed to be `XXX`.
     */
    #[Required('bank_identification_code')]
    public string $bankIdentificationCode;

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
     * The debtor's address.
     */
    #[Required('debtor_address')]
    public DebtorAddress $debtorAddress;

    /**
     * The debtor's name.
     */
    #[Required('debtor_name')]
    public string $debtorName;

    /**
     * The amount, in minor units of `instructed_currency`, to send to the creditor.
     */
    #[Required('instructed_amount')]
    public int $instructedAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code of the instructed amount.
     *
     * @var value-of<InstructedCurrency> $instructedCurrency
     */
    #[Required('instructed_currency', enum: InstructedCurrency::class)]
    public string $instructedCurrency;

    /**
     * The Account Number to include in the transfer as the debtor's account number.
     */
    #[Required('source_account_number_id')]
    public string $sourceAccountNumberID;

    /**
     * Unstructured remittance information to include in the transfer.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * The creditor's bank account routing or transit number. Required in certain countries.
     */
    #[Optional('routing_number')]
    public ?string $routingNumber;

    /**
     * `new SwiftTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SwiftTransferCreateParams::with(
     *   accountID: ...,
     *   accountNumber: ...,
     *   bankIdentificationCode: ...,
     *   creditorAddress: ...,
     *   creditorName: ...,
     *   debtorAddress: ...,
     *   debtorName: ...,
     *   instructedAmount: ...,
     *   instructedCurrency: ...,
     *   sourceAccountNumberID: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SwiftTransferCreateParams)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withBankIdentificationCode(...)
     *   ->withCreditorAddress(...)
     *   ->withCreditorName(...)
     *   ->withDebtorAddress(...)
     *   ->withDebtorName(...)
     *   ->withInstructedAmount(...)
     *   ->withInstructedCurrency(...)
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
     *
     * @param CreditorAddress|CreditorAddressShape $creditorAddress
     * @param DebtorAddress|DebtorAddressShape $debtorAddress
     * @param InstructedCurrency|value-of<InstructedCurrency> $instructedCurrency
     */
    public static function with(
        string $accountID,
        string $accountNumber,
        string $bankIdentificationCode,
        CreditorAddress|array $creditorAddress,
        string $creditorName,
        DebtorAddress|array $debtorAddress,
        string $debtorName,
        int $instructedAmount,
        InstructedCurrency|string $instructedCurrency,
        string $sourceAccountNumberID,
        string $unstructuredRemittanceInformation,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['bankIdentificationCode'] = $bankIdentificationCode;
        $self['creditorAddress'] = $creditorAddress;
        $self['creditorName'] = $creditorName;
        $self['debtorAddress'] = $debtorAddress;
        $self['debtorName'] = $debtorName;
        $self['instructedAmount'] = $instructedAmount;
        $self['instructedCurrency'] = $instructedCurrency;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        null !== $requireApproval && $self['requireApproval'] = $requireApproval;
        null !== $routingNumber && $self['routingNumber'] = $routingNumber;

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
     * The creditor's account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The bank identification code (BIC) of the creditor. If it ends with the three-character branch code, this must be 11 characters long. Otherwise this must be 8 characters and the branch code will be assumed to be `XXX`.
     */
    public function withBankIdentificationCode(
        string $bankIdentificationCode
    ): self {
        $self = clone $this;
        $self['bankIdentificationCode'] = $bankIdentificationCode;

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
     * The debtor's name.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

        return $self;
    }

    /**
     * The amount, in minor units of `instructed_currency`, to send to the creditor.
     */
    public function withInstructedAmount(int $instructedAmount): self
    {
        $self = clone $this;
        $self['instructedAmount'] = $instructedAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code of the instructed amount.
     *
     * @param InstructedCurrency|value-of<InstructedCurrency> $instructedCurrency
     */
    public function withInstructedCurrency(
        InstructedCurrency|string $instructedCurrency
    ): self {
        $self = clone $this;
        $self['instructedCurrency'] = $instructedCurrency;

        return $self;
    }

    /**
     * The Account Number to include in the transfer as the debtor's account number.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

        return $self;
    }

    /**
     * Unstructured remittance information to include in the transfer.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

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
     * The creditor's bank account routing or transit number. Required in certain countries.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }
}

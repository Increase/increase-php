<?php

declare(strict_types=1);

namespace Increase\FednowTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\FednowTransfers\FednowTransferCreateParams\CreditorAddress;
use Increase\FednowTransfers\FednowTransferCreateParams\DebtorAddress;

/**
 * Create a FedNow Transfer.
 *
 * @see Increase\Services\FednowTransfersService::create()
 *
 * @phpstan-import-type CreditorAddressShape from \Increase\FednowTransfers\FednowTransferCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\FednowTransfers\FednowTransferCreateParams\DebtorAddress
 *
 * @phpstan-type FednowTransferCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   creditorName: string,
 *   debtorName: string,
 *   sourceAccountNumberID: string,
 *   unstructuredRemittanceInformation: string,
 *   accountNumber?: string|null,
 *   creditorAddress?: null|CreditorAddress|CreditorAddressShape,
 *   debtorAddress?: null|DebtorAddress|DebtorAddressShape,
 *   externalAccountID?: string|null,
 *   requireApproval?: bool|null,
 *   routingNumber?: string|null,
 * }
 */
final class FednowTransferCreateParams implements BaseModel
{
    /** @use SdkModel<FednowTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the account that will send the transfer.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The amount, in minor units, to send to the creditor.
     */
    #[Required]
    public int $amount;

    /**
     * The creditor's name.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The debtor's name.
     */
    #[Required('debtor_name')]
    public string $debtorName;

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
     * The creditor's account number.
     */
    #[Optional('account_number')]
    public ?string $accountNumber;

    /**
     * The creditor's address.
     */
    #[Optional('creditor_address')]
    public ?CreditorAddress $creditorAddress;

    /**
     * The debtor's address.
     */
    #[Optional('debtor_address')]
    public ?DebtorAddress $debtorAddress;

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
     * The creditor's bank account routing number.
     */
    #[Optional('routing_number')]
    public ?string $routingNumber;

    /**
     * `new FednowTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FednowTransferCreateParams::with(
     *   accountID: ...,
     *   amount: ...,
     *   creditorName: ...,
     *   debtorName: ...,
     *   sourceAccountNumberID: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FednowTransferCreateParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withCreditorName(...)
     *   ->withDebtorName(...)
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
     * @param CreditorAddress|CreditorAddressShape|null $creditorAddress
     * @param DebtorAddress|DebtorAddressShape|null $debtorAddress
     */
    public static function with(
        string $accountID,
        int $amount,
        string $creditorName,
        string $debtorName,
        string $sourceAccountNumberID,
        string $unstructuredRemittanceInformation,
        ?string $accountNumber = null,
        CreditorAddress|array|null $creditorAddress = null,
        DebtorAddress|array|null $debtorAddress = null,
        ?string $externalAccountID = null,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['creditorName'] = $creditorName;
        $self['debtorName'] = $debtorName;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $creditorAddress && $self['creditorAddress'] = $creditorAddress;
        null !== $debtorAddress && $self['debtorAddress'] = $debtorAddress;
        null !== $externalAccountID && $self['externalAccountID'] = $externalAccountID;
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
     * The amount, in minor units, to send to the creditor.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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
     * The debtor's name.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

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
     * The creditor's account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

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
     * The creditor's bank account routing number.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }
}

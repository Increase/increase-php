<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\CreditorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\DebtorAddress;

/**
 * Create a Wire Drawdown Request.
 *
 * @see Increase\Services\WireDrawdownRequestsService::create()
 *
 * @phpstan-import-type CreditorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\DebtorAddress
 *
 * @phpstan-type WireDrawdownRequestCreateParamsShape = array{
 *   accountNumberID: string,
 *   amount: int,
 *   creditorAddress: CreditorAddress|CreditorAddressShape,
 *   creditorName: string,
 *   debtorAddress: DebtorAddress|DebtorAddressShape,
 *   debtorName: string,
 *   unstructuredRemittanceInformation: string,
 *   debtorAccountNumber?: string|null,
 *   debtorExternalAccountID?: string|null,
 *   debtorRoutingNumber?: string|null,
 *   endToEndIdentification?: string|null,
 * }
 */
final class WireDrawdownRequestCreateParams implements BaseModel
{
    /** @use SdkModel<WireDrawdownRequestCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Account Number to which the debtor should send funds.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The amount requested from the debtor, in USD cents.
     */
    #[Required]
    public int $amount;

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
     * Remittance information the debtor will see as part of the request.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * The debtor's account number.
     */
    #[Optional('debtor_account_number')]
    public ?string $debtorAccountNumber;

    /**
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `debtor_account_number` and `debtor_routing_number` must be absent.
     */
    #[Optional('debtor_external_account_id')]
    public ?string $debtorExternalAccountID;

    /**
     * The debtor's routing number.
     */
    #[Optional('debtor_routing_number')]
    public ?string $debtorRoutingNumber;

    /**
     * A free-form reference string set by the sender mirrored back in the subsequent wire transfer.
     */
    #[Optional('end_to_end_identification')]
    public ?string $endToEndIdentification;

    /**
     * `new WireDrawdownRequestCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WireDrawdownRequestCreateParams::with(
     *   accountNumberID: ...,
     *   amount: ...,
     *   creditorAddress: ...,
     *   creditorName: ...,
     *   debtorAddress: ...,
     *   debtorName: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WireDrawdownRequestCreateParams)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withCreditorAddress(...)
     *   ->withCreditorName(...)
     *   ->withDebtorAddress(...)
     *   ->withDebtorName(...)
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
     */
    public static function with(
        string $accountNumberID,
        int $amount,
        CreditorAddress|array $creditorAddress,
        string $creditorName,
        DebtorAddress|array $debtorAddress,
        string $debtorName,
        string $unstructuredRemittanceInformation,
        ?string $debtorAccountNumber = null,
        ?string $debtorExternalAccountID = null,
        ?string $debtorRoutingNumber = null,
        ?string $endToEndIdentification = null,
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['creditorAddress'] = $creditorAddress;
        $self['creditorName'] = $creditorName;
        $self['debtorAddress'] = $debtorAddress;
        $self['debtorName'] = $debtorName;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        null !== $debtorAccountNumber && $self['debtorAccountNumber'] = $debtorAccountNumber;
        null !== $debtorExternalAccountID && $self['debtorExternalAccountID'] = $debtorExternalAccountID;
        null !== $debtorRoutingNumber && $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        null !== $endToEndIdentification && $self['endToEndIdentification'] = $endToEndIdentification;

        return $self;
    }

    /**
     * The Account Number to which the debtor should send funds.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The amount requested from the debtor, in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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
     * Remittance information the debtor will see as part of the request.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

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
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `debtor_account_number` and `debtor_routing_number` must be absent.
     */
    public function withDebtorExternalAccountID(
        string $debtorExternalAccountID
    ): self {
        $self = clone $this;
        $self['debtorExternalAccountID'] = $debtorExternalAccountID;

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
     * A free-form reference string set by the sender mirrored back in the subsequent wire transfer.
     */
    public function withEndToEndIdentification(
        string $endToEndIdentification
    ): self {
        $self = clone $this;
        $self['endToEndIdentification'] = $endToEndIdentification;

        return $self;
    }
}

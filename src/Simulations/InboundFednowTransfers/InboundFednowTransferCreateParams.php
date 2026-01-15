<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundFednowTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an [Inbound FedNow Transfer](#inbound-fednow-transfers) to your account.
 *
 * @see Increase\Services\Simulations\InboundFednowTransfersService::create()
 *
 * @phpstan-type InboundFednowTransferCreateParamsShape = array{
 *   accountNumberID: string,
 *   amount: int,
 *   debtorAccountNumber?: string|null,
 *   debtorName?: string|null,
 *   debtorRoutingNumber?: string|null,
 *   unstructuredRemittanceInformation?: string|null,
 * }
 */
final class InboundFednowTransferCreateParams implements BaseModel
{
    /** @use SdkModel<InboundFednowTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account Number the inbound FedNow Transfer is for.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The transfer amount in USD cents. Must be positive.
     */
    #[Required]
    public int $amount;

    /**
     * The account number of the account that sent the transfer.
     */
    #[Optional('debtor_account_number')]
    public ?string $debtorAccountNumber;

    /**
     * The name provided by the sender of the transfer.
     */
    #[Optional('debtor_name')]
    public ?string $debtorName;

    /**
     * The routing number of the account that sent the transfer.
     */
    #[Optional('debtor_routing_number')]
    public ?string $debtorRoutingNumber;

    /**
     * Additional information included with the transfer.
     */
    #[Optional('unstructured_remittance_information')]
    public ?string $unstructuredRemittanceInformation;

    /**
     * `new InboundFednowTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundFednowTransferCreateParams::with(accountNumberID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundFednowTransferCreateParams)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
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
        ?string $debtorAccountNumber = null,
        ?string $debtorName = null,
        ?string $debtorRoutingNumber = null,
        ?string $unstructuredRemittanceInformation = null,
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;

        null !== $debtorAccountNumber && $self['debtorAccountNumber'] = $debtorAccountNumber;
        null !== $debtorName && $self['debtorName'] = $debtorName;
        null !== $debtorRoutingNumber && $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        null !== $unstructuredRemittanceInformation && $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }

    /**
     * The identifier of the Account Number the inbound FedNow Transfer is for.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The transfer amount in USD cents. Must be positive.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The account number of the account that sent the transfer.
     */
    public function withDebtorAccountNumber(string $debtorAccountNumber): self
    {
        $self = clone $this;
        $self['debtorAccountNumber'] = $debtorAccountNumber;

        return $self;
    }

    /**
     * The name provided by the sender of the transfer.
     */
    public function withDebtorName(string $debtorName): self
    {
        $self = clone $this;
        $self['debtorName'] = $debtorName;

        return $self;
    }

    /**
     * The routing number of the account that sent the transfer.
     */
    public function withDebtorRoutingNumber(string $debtorRoutingNumber): self
    {
        $self = clone $this;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;

        return $self;
    }

    /**
     * Additional information included with the transfer.
     */
    public function withUnstructuredRemittanceInformation(
        string $unstructuredRemittanceInformation
    ): self {
        $self = clone $this;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        return $self;
    }
}

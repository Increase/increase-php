<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor;

/**
 * Create a Real-Time Payments Request for Payment.
 *
 * @see Increase\Services\RealTimePaymentsRequestsForPaymentService::create()
 *
 * @phpstan-import-type DebtorShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor
 *
 * @phpstan-type RealTimePaymentsRequestsForPaymentCreateParamsShape = array{
 *   accountNumberID: string,
 *   amount: int,
 *   debtor: Debtor|DebtorShape,
 *   debtorAccountNumber: string,
 *   debtorRoutingNumber: string,
 *   expiresAt: \DateTimeInterface,
 *   requestedExecutionAt: \DateTimeInterface,
 *   unstructuredRemittanceInformation: string,
 *   creditorName?: string|null,
 * }
 */
final class RealTimePaymentsRequestsForPaymentCreateParams implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsRequestsForPaymentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account Number where the funds will land.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The requested amount in USD cents. Must be positive.
     */
    #[Required]
    public int $amount;

    /**
     * Details of the person being requested to pay.
     */
    #[Required]
    public Debtor $debtor;

    /**
     * The debtor's account number, which the funds will be requested from.
     */
    #[Required('debtor_account_number')]
    public string $debtorAccountNumber;

    /**
     * The debtor's American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('debtor_routing_number')]
    public string $debtorRoutingNumber;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid. After this time the debtor's bank should no longer allow the debtor to pay it. Must not be before `requested_execution_at`.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which you are requesting the payment to be made.
     */
    #[Required('requested_execution_at')]
    public \DateTimeInterface $requestedExecutionAt;

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    #[Required('unstructured_remittance_information')]
    public string $unstructuredRemittanceInformation;

    /**
     * The name of the creditor requesting the payment. If not provided, defaults to the name of the account's entity.
     */
    #[Optional('creditor_name')]
    public ?string $creditorName;

    /**
     * `new RealTimePaymentsRequestsForPaymentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimePaymentsRequestsForPaymentCreateParams::with(
     *   accountNumberID: ...,
     *   amount: ...,
     *   debtor: ...,
     *   debtorAccountNumber: ...,
     *   debtorRoutingNumber: ...,
     *   expiresAt: ...,
     *   requestedExecutionAt: ...,
     *   unstructuredRemittanceInformation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimePaymentsRequestsForPaymentCreateParams)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withDebtor(...)
     *   ->withDebtorAccountNumber(...)
     *   ->withDebtorRoutingNumber(...)
     *   ->withExpiresAt(...)
     *   ->withRequestedExecutionAt(...)
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
     * @param Debtor|DebtorShape $debtor
     */
    public static function with(
        string $accountNumberID,
        int $amount,
        Debtor|array $debtor,
        string $debtorAccountNumber,
        string $debtorRoutingNumber,
        \DateTimeInterface $expiresAt,
        \DateTimeInterface $requestedExecutionAt,
        string $unstructuredRemittanceInformation,
        ?string $creditorName = null,
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['debtor'] = $debtor;
        $self['debtorAccountNumber'] = $debtorAccountNumber;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        $self['expiresAt'] = $expiresAt;
        $self['requestedExecutionAt'] = $requestedExecutionAt;
        $self['unstructuredRemittanceInformation'] = $unstructuredRemittanceInformation;

        null !== $creditorName && $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The identifier of the Account Number where the funds will land.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The requested amount in USD cents. Must be positive.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Details of the person being requested to pay.
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
     * The debtor's account number, which the funds will be requested from.
     */
    public function withDebtorAccountNumber(string $debtorAccountNumber): self
    {
        $self = clone $this;
        $self['debtorAccountNumber'] = $debtorAccountNumber;

        return $self;
    }

    /**
     * The debtor's American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withDebtorRoutingNumber(string $debtorRoutingNumber): self
    {
        $self = clone $this;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid. After this time the debtor's bank should no longer allow the debtor to pay it. Must not be before `requested_execution_at`.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which you are requesting the payment to be made.
     */
    public function withRequestedExecutionAt(
        \DateTimeInterface $requestedExecutionAt
    ): self {
        $self = clone $this;
        $self['requestedExecutionAt'] = $requestedExecutionAt;

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
     * The name of the creditor requesting the payment. If not provided, defaults to the name of the account's entity.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }
}

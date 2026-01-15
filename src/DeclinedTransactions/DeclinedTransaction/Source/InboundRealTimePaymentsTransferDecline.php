<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundRealTimePaymentsTransferDecline\Currency;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundRealTimePaymentsTransferDecline\Reason;

/**
 * An Inbound Real-Time Payments Transfer Decline object. This field will be present in the JSON response if and only if `category` is equal to `inbound_real_time_payments_transfer_decline`.
 *
 * @phpstan-type InboundRealTimePaymentsTransferDeclineShape = array{
 *   amount: int,
 *   creditorName: string,
 *   currency: Currency|value-of<Currency>,
 *   debtorAccountNumber: string,
 *   debtorName: string,
 *   debtorRoutingNumber: string,
 *   reason: Reason|value-of<Reason>,
 *   remittanceInformation: string|null,
 *   transactionIdentification: string,
 *   transferID: string,
 * }
 */
final class InboundRealTimePaymentsTransferDecline implements BaseModel
{
    /** @use SdkModel<InboundRealTimePaymentsTransferDeclineShape> */
    use SdkModel;

    /**
     * The declined amount in the minor unit of the destination account currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The name the sender of the transfer specified as the recipient of the transfer.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the declined transfer's currency. This will always be "USD" for a Real-Time Payments transfer.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The account number of the account that sent the transfer.
     */
    #[Required('debtor_account_number')]
    public string $debtorAccountNumber;

    /**
     * The name provided by the sender of the transfer.
     */
    #[Required('debtor_name')]
    public string $debtorName;

    /**
     * The routing number of the account that sent the transfer.
     */
    #[Required('debtor_routing_number')]
    public string $debtorRoutingNumber;

    /**
     * Why the transfer was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * Additional information included with the transfer.
     */
    #[Required('remittance_information')]
    public ?string $remittanceInformation;

    /**
     * The Real-Time Payments network identification of the declined transfer.
     */
    #[Required('transaction_identification')]
    public string $transactionIdentification;

    /**
     * The identifier of the Real-Time Payments Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new InboundRealTimePaymentsTransferDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundRealTimePaymentsTransferDecline::with(
     *   amount: ...,
     *   creditorName: ...,
     *   currency: ...,
     *   debtorAccountNumber: ...,
     *   debtorName: ...,
     *   debtorRoutingNumber: ...,
     *   reason: ...,
     *   remittanceInformation: ...,
     *   transactionIdentification: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundRealTimePaymentsTransferDecline)
     *   ->withAmount(...)
     *   ->withCreditorName(...)
     *   ->withCurrency(...)
     *   ->withDebtorAccountNumber(...)
     *   ->withDebtorName(...)
     *   ->withDebtorRoutingNumber(...)
     *   ->withReason(...)
     *   ->withRemittanceInformation(...)
     *   ->withTransactionIdentification(...)
     *   ->withTransferID(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(
        int $amount,
        string $creditorName,
        Currency|string $currency,
        string $debtorAccountNumber,
        string $debtorName,
        string $debtorRoutingNumber,
        Reason|string $reason,
        ?string $remittanceInformation,
        string $transactionIdentification,
        string $transferID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['creditorName'] = $creditorName;
        $self['currency'] = $currency;
        $self['debtorAccountNumber'] = $debtorAccountNumber;
        $self['debtorName'] = $debtorName;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        $self['reason'] = $reason;
        $self['remittanceInformation'] = $remittanceInformation;
        $self['transactionIdentification'] = $transactionIdentification;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The declined amount in the minor unit of the destination account currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The name the sender of the transfer specified as the recipient of the transfer.
     */
    public function withCreditorName(string $creditorName): self
    {
        $self = clone $this;
        $self['creditorName'] = $creditorName;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the declined transfer's currency. This will always be "USD" for a Real-Time Payments transfer.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

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
     * Why the transfer was declined.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Additional information included with the transfer.
     */
    public function withRemittanceInformation(
        ?string $remittanceInformation
    ): self {
        $self = clone $this;
        $self['remittanceInformation'] = $remittanceInformation;

        return $self;
    }

    /**
     * The Real-Time Payments network identification of the declined transfer.
     */
    public function withTransactionIdentification(
        string $transactionIdentification
    ): self {
        $self = clone $this;
        $self['transactionIdentification'] = $transactionIdentification;

        return $self;
    }

    /**
     * The identifier of the Real-Time Payments Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

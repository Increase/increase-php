<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Confirmation;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Currency;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Decline;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Status;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Type;

/**
 * An Inbound Real-Time Payments Transfer is a Real-Time Payments transfer initiated outside of Increase to your account.
 *
 * @phpstan-import-type ConfirmationShape from \Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Confirmation
 * @phpstan-import-type DeclineShape from \Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer\Decline
 *
 * @phpstan-type InboundRealTimePaymentsTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumberID: string,
 *   amount: int,
 *   confirmation: null|Confirmation|ConfirmationShape,
 *   createdAt: \DateTimeInterface,
 *   creditorName: string,
 *   currency: Currency|value-of<Currency>,
 *   debtorAccountNumber: string,
 *   debtorName: string,
 *   debtorRoutingNumber: string,
 *   decline: null|Decline|DeclineShape,
 *   remittanceInformation: string|null,
 *   status: Status|value-of<Status>,
 *   transactionIdentification: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class InboundRealTimePaymentsTransfer implements BaseModel
{
    /** @use SdkModel<InboundRealTimePaymentsTransferShape> */
    use SdkModel;

    /**
     * The inbound Real-Time Payments transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account to which the transfer was sent.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The identifier of the Account Number to which this transfer was sent.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * If your transfer is confirmed, this will contain details of the confirmation.
     */
    #[Required]
    public ?Confirmation $confirmation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The name the sender of the transfer specified as the recipient of the transfer.
     */
    #[Required('creditor_name')]
    public string $creditorName;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the transfer's currency. This will always be "USD" for a Real-Time Payments transfer.
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
     * If your transfer is declined, this will contain details of the decline.
     */
    #[Required]
    public ?Decline $decline;

    /**
     * Additional information included with the transfer.
     */
    #[Required('remittance_information')]
    public ?string $remittanceInformation;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The Real-Time Payments network identification of the transfer.
     */
    #[Required('transaction_identification')]
    public string $transactionIdentification;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_real_time_payments_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new InboundRealTimePaymentsTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundRealTimePaymentsTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumberID: ...,
     *   amount: ...,
     *   confirmation: ...,
     *   createdAt: ...,
     *   creditorName: ...,
     *   currency: ...,
     *   debtorAccountNumber: ...,
     *   debtorName: ...,
     *   debtorRoutingNumber: ...,
     *   decline: ...,
     *   remittanceInformation: ...,
     *   status: ...,
     *   transactionIdentification: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundRealTimePaymentsTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withConfirmation(...)
     *   ->withCreatedAt(...)
     *   ->withCreditorName(...)
     *   ->withCurrency(...)
     *   ->withDebtorAccountNumber(...)
     *   ->withDebtorName(...)
     *   ->withDebtorRoutingNumber(...)
     *   ->withDecline(...)
     *   ->withRemittanceInformation(...)
     *   ->withStatus(...)
     *   ->withTransactionIdentification(...)
     *   ->withType(...)
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
     * @param Confirmation|ConfirmationShape|null $confirmation
     * @param Currency|value-of<Currency> $currency
     * @param Decline|DeclineShape|null $decline
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumberID,
        int $amount,
        Confirmation|array|null $confirmation,
        \DateTimeInterface $createdAt,
        string $creditorName,
        Currency|string $currency,
        string $debtorAccountNumber,
        string $debtorName,
        string $debtorRoutingNumber,
        Decline|array|null $decline,
        ?string $remittanceInformation,
        Status|string $status,
        string $transactionIdentification,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['confirmation'] = $confirmation;
        $self['createdAt'] = $createdAt;
        $self['creditorName'] = $creditorName;
        $self['currency'] = $currency;
        $self['debtorAccountNumber'] = $debtorAccountNumber;
        $self['debtorName'] = $debtorName;
        $self['debtorRoutingNumber'] = $debtorRoutingNumber;
        $self['decline'] = $decline;
        $self['remittanceInformation'] = $remittanceInformation;
        $self['status'] = $status;
        $self['transactionIdentification'] = $transactionIdentification;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The inbound Real-Time Payments transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account to which the transfer was sent.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The identifier of the Account Number to which this transfer was sent.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * If your transfer is confirmed, this will contain details of the confirmation.
     *
     * @param Confirmation|ConfirmationShape|null $confirmation
     */
    public function withConfirmation(
        Confirmation|array|null $confirmation
    ): self {
        $self = clone $this;
        $self['confirmation'] = $confirmation;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the transfer's currency. This will always be "USD" for a Real-Time Payments transfer.
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
     * If your transfer is declined, this will contain details of the decline.
     *
     * @param Decline|DeclineShape|null $decline
     */
    public function withDecline(Decline|array|null $decline): self
    {
        $self = clone $this;
        $self['decline'] = $decline;

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
     * The lifecycle status of the transfer.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The Real-Time Payments network identification of the transfer.
     */
    public function withTransactionIdentification(
        string $transactionIdentification
    ): self {
        $self = clone $this;
        $self['transactionIdentification'] = $transactionIdentification;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_real_time_payments_transfer`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

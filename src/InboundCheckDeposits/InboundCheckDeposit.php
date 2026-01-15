<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundCheckDeposits\InboundCheckDeposit\Adjustment;
use Increase\InboundCheckDeposits\InboundCheckDeposit\Currency;
use Increase\InboundCheckDeposits\InboundCheckDeposit\DepositReturn;
use Increase\InboundCheckDeposits\InboundCheckDeposit\PayeeNameAnalysis;
use Increase\InboundCheckDeposits\InboundCheckDeposit\Status;
use Increase\InboundCheckDeposits\InboundCheckDeposit\Type;

/**
 * Inbound Check Deposits are records of third-parties attempting to deposit checks against your account.
 *
 * @phpstan-import-type AdjustmentShape from \Increase\InboundCheckDeposits\InboundCheckDeposit\Adjustment
 * @phpstan-import-type DepositReturnShape from \Increase\InboundCheckDeposits\InboundCheckDeposit\DepositReturn
 *
 * @phpstan-type InboundCheckDepositShape = array{
 *   id: string,
 *   acceptedAt: \DateTimeInterface|null,
 *   accountID: string,
 *   accountNumberID: string|null,
 *   adjustments: list<Adjustment|AdjustmentShape>,
 *   amount: int,
 *   backImageFileID: string|null,
 *   bankOfFirstDepositRoutingNumber: string|null,
 *   checkNumber: string|null,
 *   checkTransferID: string|null,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   declinedAt: \DateTimeInterface|null,
 *   declinedTransactionID: string|null,
 *   depositReturn: null|DepositReturn|DepositReturnShape,
 *   frontImageFileID: string|null,
 *   payeeNameAnalysis: PayeeNameAnalysis|value-of<PayeeNameAnalysis>,
 *   status: Status|value-of<Status>,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class InboundCheckDeposit implements BaseModel
{
    /** @use SdkModel<InboundCheckDepositShape> */
    use SdkModel;

    /**
     * The deposit's identifier.
     */
    #[Required]
    public string $id;

    /**
     * If the Inbound Check Deposit was accepted, the [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which this took place.
     */
    #[Required('accepted_at')]
    public ?\DateTimeInterface $acceptedAt;

    /**
     * The Account the check is being deposited against.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Account Number the check is being deposited against.
     */
    #[Required('account_number_id')]
    public ?string $accountNumberID;

    /**
     * If the deposit or the return was adjusted by the sending institution, this will contain details of the adjustments.
     *
     * @var list<Adjustment> $adjustments
     */
    #[Required(list: Adjustment::class)]
    public array $adjustments;

    /**
     * The deposited amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The ID for the File containing the image of the back of the check.
     */
    #[Required('back_image_file_id')]
    public ?string $backImageFileID;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the bank depositing this check. In some rare cases, this is not transmitted via Check21 and the value will be null.
     */
    #[Required('bank_of_first_deposit_routing_number')]
    public ?string $bankOfFirstDepositRoutingNumber;

    /**
     * The check number printed on the check being deposited.
     */
    #[Required('check_number')]
    public ?string $checkNumber;

    /**
     * If this deposit is for an existing Check Transfer, the identifier of that Check Transfer.
     */
    #[Required('check_transfer_id')]
    public ?string $checkTransferID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the deposit was attempted.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the deposit.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * If the Inbound Check Deposit was declined, the [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which this took place.
     */
    #[Required('declined_at')]
    public ?\DateTimeInterface $declinedAt;

    /**
     * If the deposit attempt has been rejected, the identifier of the Declined Transaction object created as a result of the failed deposit.
     */
    #[Required('declined_transaction_id')]
    public ?string $declinedTransactionID;

    /**
     * If you requested a return of this deposit, this will contain details of the return.
     */
    #[Required('deposit_return')]
    public ?DepositReturn $depositReturn;

    /**
     * The ID for the File containing the image of the front of the check.
     */
    #[Required('front_image_file_id')]
    public ?string $frontImageFileID;

    /**
     * Whether the details on the check match the recipient name of the check transfer. This is an optional feature, contact sales to enable.
     *
     * @var value-of<PayeeNameAnalysis> $payeeNameAnalysis
     */
    #[Required('payee_name_analysis', enum: PayeeNameAnalysis::class)]
    public string $payeeNameAnalysis;

    /**
     * The status of the Inbound Check Deposit.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * If the deposit attempt has been accepted, the identifier of the Transaction object created as a result of the successful deposit.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_check_deposit`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new InboundCheckDeposit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundCheckDeposit::with(
     *   id: ...,
     *   acceptedAt: ...,
     *   accountID: ...,
     *   accountNumberID: ...,
     *   adjustments: ...,
     *   amount: ...,
     *   backImageFileID: ...,
     *   bankOfFirstDepositRoutingNumber: ...,
     *   checkNumber: ...,
     *   checkTransferID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   declinedAt: ...,
     *   declinedTransactionID: ...,
     *   depositReturn: ...,
     *   frontImageFileID: ...,
     *   payeeNameAnalysis: ...,
     *   status: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundCheckDeposit)
     *   ->withID(...)
     *   ->withAcceptedAt(...)
     *   ->withAccountID(...)
     *   ->withAccountNumberID(...)
     *   ->withAdjustments(...)
     *   ->withAmount(...)
     *   ->withBackImageFileID(...)
     *   ->withBankOfFirstDepositRoutingNumber(...)
     *   ->withCheckNumber(...)
     *   ->withCheckTransferID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withDeclinedAt(...)
     *   ->withDeclinedTransactionID(...)
     *   ->withDepositReturn(...)
     *   ->withFrontImageFileID(...)
     *   ->withPayeeNameAnalysis(...)
     *   ->withStatus(...)
     *   ->withTransactionID(...)
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
     * @param list<Adjustment|AdjustmentShape> $adjustments
     * @param Currency|value-of<Currency> $currency
     * @param DepositReturn|DepositReturnShape|null $depositReturn
     * @param PayeeNameAnalysis|value-of<PayeeNameAnalysis> $payeeNameAnalysis
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?\DateTimeInterface $acceptedAt,
        string $accountID,
        ?string $accountNumberID,
        array $adjustments,
        int $amount,
        ?string $backImageFileID,
        ?string $bankOfFirstDepositRoutingNumber,
        ?string $checkNumber,
        ?string $checkTransferID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        ?\DateTimeInterface $declinedAt,
        ?string $declinedTransactionID,
        DepositReturn|array|null $depositReturn,
        ?string $frontImageFileID,
        PayeeNameAnalysis|string $payeeNameAnalysis,
        Status|string $status,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['acceptedAt'] = $acceptedAt;
        $self['accountID'] = $accountID;
        $self['accountNumberID'] = $accountNumberID;
        $self['adjustments'] = $adjustments;
        $self['amount'] = $amount;
        $self['backImageFileID'] = $backImageFileID;
        $self['bankOfFirstDepositRoutingNumber'] = $bankOfFirstDepositRoutingNumber;
        $self['checkNumber'] = $checkNumber;
        $self['checkTransferID'] = $checkTransferID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['declinedAt'] = $declinedAt;
        $self['declinedTransactionID'] = $declinedTransactionID;
        $self['depositReturn'] = $depositReturn;
        $self['frontImageFileID'] = $frontImageFileID;
        $self['payeeNameAnalysis'] = $payeeNameAnalysis;
        $self['status'] = $status;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The deposit's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * If the Inbound Check Deposit was accepted, the [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which this took place.
     */
    public function withAcceptedAt(?\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The Account the check is being deposited against.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Account Number the check is being deposited against.
     */
    public function withAccountNumberID(?string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * If the deposit or the return was adjusted by the sending institution, this will contain details of the adjustments.
     *
     * @param list<Adjustment|AdjustmentShape> $adjustments
     */
    public function withAdjustments(array $adjustments): self
    {
        $self = clone $this;
        $self['adjustments'] = $adjustments;

        return $self;
    }

    /**
     * The deposited amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The ID for the File containing the image of the back of the check.
     */
    public function withBackImageFileID(?string $backImageFileID): self
    {
        $self = clone $this;
        $self['backImageFileID'] = $backImageFileID;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the bank depositing this check. In some rare cases, this is not transmitted via Check21 and the value will be null.
     */
    public function withBankOfFirstDepositRoutingNumber(
        ?string $bankOfFirstDepositRoutingNumber
    ): self {
        $self = clone $this;
        $self['bankOfFirstDepositRoutingNumber'] = $bankOfFirstDepositRoutingNumber;

        return $self;
    }

    /**
     * The check number printed on the check being deposited.
     */
    public function withCheckNumber(?string $checkNumber): self
    {
        $self = clone $this;
        $self['checkNumber'] = $checkNumber;

        return $self;
    }

    /**
     * If this deposit is for an existing Check Transfer, the identifier of that Check Transfer.
     */
    public function withCheckTransferID(?string $checkTransferID): self
    {
        $self = clone $this;
        $self['checkTransferID'] = $checkTransferID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the deposit was attempted.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the deposit.
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
     * If the Inbound Check Deposit was declined, the [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which this took place.
     */
    public function withDeclinedAt(?\DateTimeInterface $declinedAt): self
    {
        $self = clone $this;
        $self['declinedAt'] = $declinedAt;

        return $self;
    }

    /**
     * If the deposit attempt has been rejected, the identifier of the Declined Transaction object created as a result of the failed deposit.
     */
    public function withDeclinedTransactionID(
        ?string $declinedTransactionID
    ): self {
        $self = clone $this;
        $self['declinedTransactionID'] = $declinedTransactionID;

        return $self;
    }

    /**
     * If you requested a return of this deposit, this will contain details of the return.
     *
     * @param DepositReturn|DepositReturnShape|null $depositReturn
     */
    public function withDepositReturn(
        DepositReturn|array|null $depositReturn
    ): self {
        $self = clone $this;
        $self['depositReturn'] = $depositReturn;

        return $self;
    }

    /**
     * The ID for the File containing the image of the front of the check.
     */
    public function withFrontImageFileID(?string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * Whether the details on the check match the recipient name of the check transfer. This is an optional feature, contact sales to enable.
     *
     * @param PayeeNameAnalysis|value-of<PayeeNameAnalysis> $payeeNameAnalysis
     */
    public function withPayeeNameAnalysis(
        PayeeNameAnalysis|string $payeeNameAnalysis
    ): self {
        $self = clone $this;
        $self['payeeNameAnalysis'] = $payeeNameAnalysis;

        return $self;
    }

    /**
     * The status of the Inbound Check Deposit.
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
     * If the deposit attempt has been accepted, the identifier of the Transaction object created as a result of the successful deposit.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_check_deposit`.
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

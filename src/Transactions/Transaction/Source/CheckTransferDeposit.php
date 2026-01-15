<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CheckTransferDeposit\Type;

/**
 * A Check Transfer Deposit object. This field will be present in the JSON response if and only if `category` is equal to `check_transfer_deposit`. An Inbound Check is a check drawn on an Increase account that has been deposited by an external bank account. These types of checks are not pre-registered.
 *
 * @phpstan-type CheckTransferDepositShape = array{
 *   backImageFileID: string|null,
 *   bankOfFirstDepositRoutingNumber: string|null,
 *   depositedAt: \DateTimeInterface,
 *   frontImageFileID: string|null,
 *   inboundCheckDepositID: string|null,
 *   transactionID: string|null,
 *   transferID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class CheckTransferDeposit implements BaseModel
{
    /** @use SdkModel<CheckTransferDepositShape> */
    use SdkModel;

    /**
     * The identifier of the API File object containing an image of the back of the deposited check.
     */
    #[Required('back_image_file_id')]
    public ?string $backImageFileID;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the bank depositing this check. In some rare cases, this is not transmitted via Check21 and the value will be null.
     */
    #[Required('bank_of_first_deposit_routing_number')]
    public ?string $bankOfFirstDepositRoutingNumber;

    /**
     * When the check was deposited.
     */
    #[Required('deposited_at')]
    public \DateTimeInterface $depositedAt;

    /**
     * The identifier of the API File object containing an image of the front of the deposited check.
     */
    #[Required('front_image_file_id')]
    public ?string $frontImageFileID;

    /**
     * The identifier of the Inbound Check Deposit object associated with this transaction.
     */
    #[Required('inbound_check_deposit_id')]
    public ?string $inboundCheckDepositID;

    /**
     * The identifier of the Transaction object created when the check was deposited.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * The identifier of the Check Transfer object that was deposited.
     */
    #[Required('transfer_id')]
    public ?string $transferID;

    /**
     * A constant representing the object's type. For this resource it will always be `check_transfer_deposit`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CheckTransferDeposit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckTransferDeposit::with(
     *   backImageFileID: ...,
     *   bankOfFirstDepositRoutingNumber: ...,
     *   depositedAt: ...,
     *   frontImageFileID: ...,
     *   inboundCheckDepositID: ...,
     *   transactionID: ...,
     *   transferID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckTransferDeposit)
     *   ->withBackImageFileID(...)
     *   ->withBankOfFirstDepositRoutingNumber(...)
     *   ->withDepositedAt(...)
     *   ->withFrontImageFileID(...)
     *   ->withInboundCheckDepositID(...)
     *   ->withTransactionID(...)
     *   ->withTransferID(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?string $backImageFileID,
        ?string $bankOfFirstDepositRoutingNumber,
        \DateTimeInterface $depositedAt,
        ?string $frontImageFileID,
        ?string $inboundCheckDepositID,
        ?string $transactionID,
        ?string $transferID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['backImageFileID'] = $backImageFileID;
        $self['bankOfFirstDepositRoutingNumber'] = $bankOfFirstDepositRoutingNumber;
        $self['depositedAt'] = $depositedAt;
        $self['frontImageFileID'] = $frontImageFileID;
        $self['inboundCheckDepositID'] = $inboundCheckDepositID;
        $self['transactionID'] = $transactionID;
        $self['transferID'] = $transferID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The identifier of the API File object containing an image of the back of the deposited check.
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
     * When the check was deposited.
     */
    public function withDepositedAt(\DateTimeInterface $depositedAt): self
    {
        $self = clone $this;
        $self['depositedAt'] = $depositedAt;

        return $self;
    }

    /**
     * The identifier of the API File object containing an image of the front of the deposited check.
     */
    public function withFrontImageFileID(?string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * The identifier of the Inbound Check Deposit object associated with this transaction.
     */
    public function withInboundCheckDepositID(
        ?string $inboundCheckDepositID
    ): self {
        $self = clone $this;
        $self['inboundCheckDepositID'] = $inboundCheckDepositID;

        return $self;
    }

    /**
     * The identifier of the Transaction object created when the check was deposited.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The identifier of the Check Transfer object that was deposited.
     */
    public function withTransferID(?string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `check_transfer_deposit`.
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

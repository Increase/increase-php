<?php

declare(strict_types=1);

namespace Increase\CheckDeposits;

use Increase\CheckDeposits\CheckDeposit\DepositAcceptance;
use Increase\CheckDeposits\CheckDeposit\DepositRejection;
use Increase\CheckDeposits\CheckDeposit\DepositReturn;
use Increase\CheckDeposits\CheckDeposit\DepositSubmission;
use Increase\CheckDeposits\CheckDeposit\InboundFundsHold;
use Increase\CheckDeposits\CheckDeposit\Status;
use Increase\CheckDeposits\CheckDeposit\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Check Deposits allow you to deposit images of paper checks into your account.
 *
 * @phpstan-import-type DepositAcceptanceShape from \Increase\CheckDeposits\CheckDeposit\DepositAcceptance
 * @phpstan-import-type DepositRejectionShape from \Increase\CheckDeposits\CheckDeposit\DepositRejection
 * @phpstan-import-type DepositReturnShape from \Increase\CheckDeposits\CheckDeposit\DepositReturn
 * @phpstan-import-type DepositSubmissionShape from \Increase\CheckDeposits\CheckDeposit\DepositSubmission
 * @phpstan-import-type InboundFundsHoldShape from \Increase\CheckDeposits\CheckDeposit\InboundFundsHold
 *
 * @phpstan-type CheckDepositShape = array{
 *   id: string,
 *   accountID: string,
 *   amount: int,
 *   backImageFileID: string|null,
 *   createdAt: \DateTimeInterface,
 *   depositAcceptance: null|DepositAcceptance|DepositAcceptanceShape,
 *   depositRejection: null|DepositRejection|DepositRejectionShape,
 *   depositReturn: null|DepositReturn|DepositReturnShape,
 *   depositSubmission: null|DepositSubmission|DepositSubmissionShape,
 *   description: string|null,
 *   frontImageFileID: string,
 *   idempotencyKey: string|null,
 *   inboundFundsHold: null|InboundFundsHold|InboundFundsHoldShape,
 *   inboundMailItemID: string|null,
 *   lockboxID: string|null,
 *   status: Status|value-of<Status>,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class CheckDeposit implements BaseModel
{
    /** @use SdkModel<CheckDepositShape> */
    use SdkModel;

    /**
     * The deposit's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account the check was deposited into.
     */
    #[Required('account_id')]
    public string $accountID;

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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Once your deposit is successfully parsed and accepted by Increase, this will contain details of the parsed check.
     */
    #[Required('deposit_acceptance')]
    public ?DepositAcceptance $depositAcceptance;

    /**
     * If your deposit is rejected by Increase, this will contain details as to why it was rejected.
     */
    #[Required('deposit_rejection')]
    public ?DepositRejection $depositRejection;

    /**
     * If your deposit is returned, this will contain details as to why it was returned.
     */
    #[Required('deposit_return')]
    public ?DepositReturn $depositReturn;

    /**
     * After the check is parsed, it is submitted to the Check21 network for processing. This will contain details of the submission.
     */
    #[Required('deposit_submission')]
    public ?DepositSubmission $depositSubmission;

    /**
     * The description of the Check Deposit, for display purposes only.
     */
    #[Required]
    public ?string $description;

    /**
     * The ID for the File containing the image of the front of the check.
     */
    #[Required('front_image_file_id')]
    public string $frontImageFileID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * Increase will sometimes hold the funds for Check Deposits. If funds are held, this sub-object will contain details of the hold.
     */
    #[Required('inbound_funds_hold')]
    public ?InboundFundsHold $inboundFundsHold;

    /**
     * If the Check Deposit was the result of an Inbound Mail Item, this will contain the identifier of the Inbound Mail Item.
     */
    #[Required('inbound_mail_item_id')]
    public ?string $inboundMailItemID;

    /**
     * If the Check Deposit was the result of an Inbound Mail Item, this will contain the identifier of the Lockbox that received it.
     */
    #[Required('lockbox_id')]
    public ?string $lockboxID;

    /**
     * The status of the Check Deposit.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The ID for the Transaction created by the deposit.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `check_deposit`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CheckDeposit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckDeposit::with(
     *   id: ...,
     *   accountID: ...,
     *   amount: ...,
     *   backImageFileID: ...,
     *   createdAt: ...,
     *   depositAcceptance: ...,
     *   depositRejection: ...,
     *   depositReturn: ...,
     *   depositSubmission: ...,
     *   description: ...,
     *   frontImageFileID: ...,
     *   idempotencyKey: ...,
     *   inboundFundsHold: ...,
     *   inboundMailItemID: ...,
     *   lockboxID: ...,
     *   status: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckDeposit)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withBackImageFileID(...)
     *   ->withCreatedAt(...)
     *   ->withDepositAcceptance(...)
     *   ->withDepositRejection(...)
     *   ->withDepositReturn(...)
     *   ->withDepositSubmission(...)
     *   ->withDescription(...)
     *   ->withFrontImageFileID(...)
     *   ->withIdempotencyKey(...)
     *   ->withInboundFundsHold(...)
     *   ->withInboundMailItemID(...)
     *   ->withLockboxID(...)
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
     * @param DepositAcceptance|DepositAcceptanceShape|null $depositAcceptance
     * @param DepositRejection|DepositRejectionShape|null $depositRejection
     * @param DepositReturn|DepositReturnShape|null $depositReturn
     * @param DepositSubmission|DepositSubmissionShape|null $depositSubmission
     * @param InboundFundsHold|InboundFundsHoldShape|null $inboundFundsHold
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        int $amount,
        ?string $backImageFileID,
        \DateTimeInterface $createdAt,
        DepositAcceptance|array|null $depositAcceptance,
        DepositRejection|array|null $depositRejection,
        DepositReturn|array|null $depositReturn,
        DepositSubmission|array|null $depositSubmission,
        ?string $description,
        string $frontImageFileID,
        ?string $idempotencyKey,
        InboundFundsHold|array|null $inboundFundsHold,
        ?string $inboundMailItemID,
        ?string $lockboxID,
        Status|string $status,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['backImageFileID'] = $backImageFileID;
        $self['createdAt'] = $createdAt;
        $self['depositAcceptance'] = $depositAcceptance;
        $self['depositRejection'] = $depositRejection;
        $self['depositReturn'] = $depositReturn;
        $self['depositSubmission'] = $depositSubmission;
        $self['description'] = $description;
        $self['frontImageFileID'] = $frontImageFileID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['inboundFundsHold'] = $inboundFundsHold;
        $self['inboundMailItemID'] = $inboundMailItemID;
        $self['lockboxID'] = $lockboxID;
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
     * The Account the check was deposited into.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Once your deposit is successfully parsed and accepted by Increase, this will contain details of the parsed check.
     *
     * @param DepositAcceptance|DepositAcceptanceShape|null $depositAcceptance
     */
    public function withDepositAcceptance(
        DepositAcceptance|array|null $depositAcceptance
    ): self {
        $self = clone $this;
        $self['depositAcceptance'] = $depositAcceptance;

        return $self;
    }

    /**
     * If your deposit is rejected by Increase, this will contain details as to why it was rejected.
     *
     * @param DepositRejection|DepositRejectionShape|null $depositRejection
     */
    public function withDepositRejection(
        DepositRejection|array|null $depositRejection
    ): self {
        $self = clone $this;
        $self['depositRejection'] = $depositRejection;

        return $self;
    }

    /**
     * If your deposit is returned, this will contain details as to why it was returned.
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
     * After the check is parsed, it is submitted to the Check21 network for processing. This will contain details of the submission.
     *
     * @param DepositSubmission|DepositSubmissionShape|null $depositSubmission
     */
    public function withDepositSubmission(
        DepositSubmission|array|null $depositSubmission
    ): self {
        $self = clone $this;
        $self['depositSubmission'] = $depositSubmission;

        return $self;
    }

    /**
     * The description of the Check Deposit, for display purposes only.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The ID for the File containing the image of the front of the check.
     */
    public function withFrontImageFileID(string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Increase will sometimes hold the funds for Check Deposits. If funds are held, this sub-object will contain details of the hold.
     *
     * @param InboundFundsHold|InboundFundsHoldShape|null $inboundFundsHold
     */
    public function withInboundFundsHold(
        InboundFundsHold|array|null $inboundFundsHold
    ): self {
        $self = clone $this;
        $self['inboundFundsHold'] = $inboundFundsHold;

        return $self;
    }

    /**
     * If the Check Deposit was the result of an Inbound Mail Item, this will contain the identifier of the Inbound Mail Item.
     */
    public function withInboundMailItemID(?string $inboundMailItemID): self
    {
        $self = clone $this;
        $self['inboundMailItemID'] = $inboundMailItemID;

        return $self;
    }

    /**
     * If the Check Deposit was the result of an Inbound Mail Item, this will contain the identifier of the Lockbox that received it.
     */
    public function withLockboxID(?string $lockboxID): self
    {
        $self = clone $this;
        $self['lockboxID'] = $lockboxID;

        return $self;
    }

    /**
     * The status of the Check Deposit.
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
     * The ID for the Transaction created by the deposit.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `check_deposit`.
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

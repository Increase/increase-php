<?php

declare(strict_types=1);

namespace Increase\CardDisputes;

use Increase\CardDisputes\CardDispute\Loss;
use Increase\CardDisputes\CardDispute\Network;
use Increase\CardDisputes\CardDispute\Status;
use Increase\CardDisputes\CardDispute\Type;
use Increase\CardDisputes\CardDispute\Visa;
use Increase\CardDisputes\CardDispute\Win;
use Increase\CardDisputes\CardDispute\Withdrawal;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If unauthorized activity occurs on a card, you can create a Card Dispute and we'll work with the card networks to return the funds if appropriate.
 *
 * @phpstan-import-type LossShape from \Increase\CardDisputes\CardDispute\Loss
 * @phpstan-import-type VisaShape from \Increase\CardDisputes\CardDispute\Visa
 * @phpstan-import-type WinShape from \Increase\CardDisputes\CardDispute\Win
 * @phpstan-import-type WithdrawalShape from \Increase\CardDisputes\CardDispute\Withdrawal
 *
 * @phpstan-type CardDisputeShape = array{
 *   id: string,
 *   amount: int,
 *   cardID: string,
 *   createdAt: \DateTimeInterface,
 *   disputedTransactionID: string,
 *   idempotencyKey: string|null,
 *   loss: null|Loss|LossShape,
 *   network: Network|value-of<Network>,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   userSubmissionRequiredBy: \DateTimeInterface|null,
 *   visa: null|Visa|VisaShape,
 *   win: null|Win|WinShape,
 *   withdrawal: null|Withdrawal|WithdrawalShape,
 * }
 */
final class CardDispute implements BaseModel
{
    /** @use SdkModel<CardDisputeShape> */
    use SdkModel;

    /**
     * The Card Dispute identifier.
     */
    #[Required]
    public string $id;

    /**
     * The amount of the dispute.
     */
    #[Required]
    public int $amount;

    /**
     * The Card that the Card Dispute is associated with.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The identifier of the Transaction that was disputed.
     */
    #[Required('disputed_transaction_id')]
    public string $disputedTransactionID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * If the Card Dispute's status is `lost`, this will contain details of the lost dispute.
     */
    #[Required]
    public ?Loss $loss;

    /**
     * The network that the Card Dispute is associated with.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The status of the Card Dispute.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `card_dispute`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the user submission is required by. Present only if status is `user_submission_required` and a user submission is required by a certain time. Otherwise, this will be `nil`.
     */
    #[Required('user_submission_required_by')]
    public ?\DateTimeInterface $userSubmissionRequiredBy;

    /**
     * Card Dispute information for card payments processed over Visa's network. This field will be present in the JSON response if and only if `network` is equal to `visa`.
     */
    #[Required]
    public ?Visa $visa;

    /**
     * If the Card Dispute's status is `won`, this will contain details of the won dispute.
     */
    #[Required]
    public ?Win $win;

    /**
     * If the Card Dispute has been withdrawn, this will contain details of the withdrawal.
     */
    #[Required]
    public ?Withdrawal $withdrawal;

    /**
     * `new CardDispute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDispute::with(
     *   id: ...,
     *   amount: ...,
     *   cardID: ...,
     *   createdAt: ...,
     *   disputedTransactionID: ...,
     *   idempotencyKey: ...,
     *   loss: ...,
     *   network: ...,
     *   status: ...,
     *   type: ...,
     *   userSubmissionRequiredBy: ...,
     *   visa: ...,
     *   win: ...,
     *   withdrawal: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDispute)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCardID(...)
     *   ->withCreatedAt(...)
     *   ->withDisputedTransactionID(...)
     *   ->withIdempotencyKey(...)
     *   ->withLoss(...)
     *   ->withNetwork(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withUserSubmissionRequiredBy(...)
     *   ->withVisa(...)
     *   ->withWin(...)
     *   ->withWithdrawal(...)
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
     * @param Loss|LossShape|null $loss
     * @param Network|value-of<Network> $network
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     * @param Visa|VisaShape|null $visa
     * @param Win|WinShape|null $win
     * @param Withdrawal|WithdrawalShape|null $withdrawal
     */
    public static function with(
        string $id,
        int $amount,
        string $cardID,
        \DateTimeInterface $createdAt,
        string $disputedTransactionID,
        ?string $idempotencyKey,
        Loss|array|null $loss,
        Network|string $network,
        Status|string $status,
        Type|string $type,
        ?\DateTimeInterface $userSubmissionRequiredBy,
        Visa|array|null $visa,
        Win|array|null $win,
        Withdrawal|array|null $withdrawal,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['cardID'] = $cardID;
        $self['createdAt'] = $createdAt;
        $self['disputedTransactionID'] = $disputedTransactionID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['loss'] = $loss;
        $self['network'] = $network;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['userSubmissionRequiredBy'] = $userSubmissionRequiredBy;
        $self['visa'] = $visa;
        $self['win'] = $win;
        $self['withdrawal'] = $withdrawal;

        return $self;
    }

    /**
     * The Card Dispute identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The amount of the dispute.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The Card that the Card Dispute is associated with.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The identifier of the Transaction that was disputed.
     */
    public function withDisputedTransactionID(
        string $disputedTransactionID
    ): self {
        $self = clone $this;
        $self['disputedTransactionID'] = $disputedTransactionID;

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
     * If the Card Dispute's status is `lost`, this will contain details of the lost dispute.
     *
     * @param Loss|LossShape|null $loss
     */
    public function withLoss(Loss|array|null $loss): self
    {
        $self = clone $this;
        $self['loss'] = $loss;

        return $self;
    }

    /**
     * The network that the Card Dispute is associated with.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * The status of the Card Dispute.
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
     * A constant representing the object's type. For this resource it will always be `card_dispute`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the user submission is required by. Present only if status is `user_submission_required` and a user submission is required by a certain time. Otherwise, this will be `nil`.
     */
    public function withUserSubmissionRequiredBy(
        ?\DateTimeInterface $userSubmissionRequiredBy
    ): self {
        $self = clone $this;
        $self['userSubmissionRequiredBy'] = $userSubmissionRequiredBy;

        return $self;
    }

    /**
     * Card Dispute information for card payments processed over Visa's network. This field will be present in the JSON response if and only if `network` is equal to `visa`.
     *
     * @param Visa|VisaShape|null $visa
     */
    public function withVisa(Visa|array|null $visa): self
    {
        $self = clone $this;
        $self['visa'] = $visa;

        return $self;
    }

    /**
     * If the Card Dispute's status is `won`, this will contain details of the won dispute.
     *
     * @param Win|WinShape|null $win
     */
    public function withWin(Win|array|null $win): self
    {
        $self = clone $this;
        $self['win'] = $win;

        return $self;
    }

    /**
     * If the Card Dispute has been withdrawn, this will contain details of the withdrawal.
     *
     * @param Withdrawal|WithdrawalShape|null $withdrawal
     */
    public function withWithdrawal(Withdrawal|array|null $withdrawal): self
    {
        $self = clone $this;
        $self['withdrawal'] = $withdrawal;

        return $self;
    }
}

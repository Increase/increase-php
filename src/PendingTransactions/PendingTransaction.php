<?php

declare(strict_types=1);

namespace Increase\PendingTransactions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Currency;
use Increase\PendingTransactions\PendingTransaction\RouteType;
use Increase\PendingTransactions\PendingTransaction\Source;
use Increase\PendingTransactions\PendingTransaction\Status;
use Increase\PendingTransactions\PendingTransaction\Type;

/**
 * Pending Transactions are potential future additions and removals of money from your bank account. They impact your available balance, but not your current balance. To learn more, see [Transactions and Transfers](/documentation/transactions-transfers).
 *
 * @phpstan-import-type SourceShape from \Increase\PendingTransactions\PendingTransaction\Source
 *
 * @phpstan-type PendingTransactionShape = array{
 *   id: string,
 *   accountID: string,
 *   amount: int,
 *   completedAt: \DateTimeInterface|null,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   description: string,
 *   heldAmount: int,
 *   routeID: string|null,
 *   routeType: null|RouteType|value-of<RouteType>,
 *   source: Source|SourceShape,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class PendingTransaction implements BaseModel
{
    /** @use SdkModel<PendingTransactionShape> */
    use SdkModel;

    /**
     * The Pending Transaction identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the account this Pending Transaction belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Pending Transaction amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Pending Transaction was completed.
     */
    #[Required('completed_at')]
    public ?\DateTimeInterface $completedAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Pending Transaction occurred.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Pending Transaction's currency. This will match the currency on the Pending Transaction's Account.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * For a Pending Transaction related to a transfer, this is the description you provide. For a Pending Transaction related to a payment, this is the description the vendor provides.
     */
    #[Required]
    public string $description;

    /**
     * The amount that this Pending Transaction decrements the available balance of its Account. This is usually the same as `amount`, but will differ if the amount is positive.
     */
    #[Required('held_amount')]
    public int $heldAmount;

    /**
     * The identifier for the route this Pending Transaction came through. Routes are things like cards and ACH details.
     */
    #[Required('route_id')]
    public ?string $routeID;

    /**
     * The type of the route this Pending Transaction came through.
     *
     * @var value-of<RouteType>|null $routeType
     */
    #[Required('route_type', enum: RouteType::class)]
    public ?string $routeType;

    /**
     * This is an object giving more details on the network-level event that caused the Pending Transaction. For example, for a card transaction this lists the merchant's industry and location.
     */
    #[Required]
    public Source $source;

    /**
     * Whether the Pending Transaction has been confirmed and has an associated Transaction.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `pending_transaction`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new PendingTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PendingTransaction::with(
     *   id: ...,
     *   accountID: ...,
     *   amount: ...,
     *   completedAt: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   description: ...,
     *   heldAmount: ...,
     *   routeID: ...,
     *   routeType: ...,
     *   source: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PendingTransaction)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withCompletedAt(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withDescription(...)
     *   ->withHeldAmount(...)
     *   ->withRouteID(...)
     *   ->withRouteType(...)
     *   ->withSource(...)
     *   ->withStatus(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param RouteType|value-of<RouteType>|null $routeType
     * @param Source|SourceShape $source
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        int $amount,
        ?\DateTimeInterface $completedAt,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        string $description,
        int $heldAmount,
        ?string $routeID,
        RouteType|string|null $routeType,
        Source|array $source,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['completedAt'] = $completedAt;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['description'] = $description;
        $self['heldAmount'] = $heldAmount;
        $self['routeID'] = $routeID;
        $self['routeType'] = $routeType;
        $self['source'] = $source;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Pending Transaction identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the account this Pending Transaction belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Pending Transaction amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Pending Transaction was completed.
     */
    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Pending Transaction occurred.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Pending Transaction's currency. This will match the currency on the Pending Transaction's Account.
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
     * For a Pending Transaction related to a transfer, this is the description you provide. For a Pending Transaction related to a payment, this is the description the vendor provides.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The amount that this Pending Transaction decrements the available balance of its Account. This is usually the same as `amount`, but will differ if the amount is positive.
     */
    public function withHeldAmount(int $heldAmount): self
    {
        $self = clone $this;
        $self['heldAmount'] = $heldAmount;

        return $self;
    }

    /**
     * The identifier for the route this Pending Transaction came through. Routes are things like cards and ACH details.
     */
    public function withRouteID(?string $routeID): self
    {
        $self = clone $this;
        $self['routeID'] = $routeID;

        return $self;
    }

    /**
     * The type of the route this Pending Transaction came through.
     *
     * @param RouteType|value-of<RouteType>|null $routeType
     */
    public function withRouteType(RouteType|string|null $routeType): self
    {
        $self = clone $this;
        $self['routeType'] = $routeType;

        return $self;
    }

    /**
     * This is an object giving more details on the network-level event that caused the Pending Transaction. For example, for a card transaction this lists the merchant's industry and location.
     *
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Whether the Pending Transaction has been confirmed and has an associated Transaction.
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
     * A constant representing the object's type. For this resource it will always be `pending_transaction`.
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

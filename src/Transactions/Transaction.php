<?php

declare(strict_types=1);

namespace Increase\Transactions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Currency;
use Increase\Transactions\Transaction\RouteType;
use Increase\Transactions\Transaction\Source;
use Increase\Transactions\Transaction\Type;

/**
 * Transactions are the immutable additions and removals of money from your bank account. They're the equivalent of line items on your bank statement. To learn more, see [Transactions and Transfers](/documentation/transactions-transfers).
 *
 * @phpstan-import-type SourceShape from \Increase\Transactions\Transaction\Source
 *
 * @phpstan-type TransactionShape = array{
 *   id: string,
 *   accountID: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   description: string,
 *   routeID: string|null,
 *   routeType: null|RouteType|value-of<RouteType>,
 *   source: Source|SourceShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class Transaction implements BaseModel
{
    /** @use SdkModel<TransactionShape> */
    use SdkModel;

    /**
     * The Transaction identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account the Transaction belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Transaction amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Transaction occurred.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Transaction's currency. This will match the currency on the Transaction's Account.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * An informational message describing this transaction. Use the fields in `source` to get more detailed information. This field appears as the line-item on the statement.
     */
    #[Required]
    public string $description;

    /**
     * The identifier for the route this Transaction came through. Routes are things like cards and ACH details.
     */
    #[Required('route_id')]
    public ?string $routeID;

    /**
     * The type of the route this Transaction came through.
     *
     * @var value-of<RouteType>|null $routeType
     */
    #[Required('route_type', enum: RouteType::class)]
    public ?string $routeType;

    /**
     * This is an object giving more details on the network-level event that caused the Transaction. Note that for backwards compatibility reasons, additional undocumented keys may appear in this object. These should be treated as deprecated and will be removed in the future.
     */
    #[Required]
    public Source $source;

    /**
     * A constant representing the object's type. For this resource it will always be `transaction`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Transaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transaction::with(
     *   id: ...,
     *   accountID: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   description: ...,
     *   routeID: ...,
     *   routeType: ...,
     *   source: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transaction)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withDescription(...)
     *   ->withRouteID(...)
     *   ->withRouteType(...)
     *   ->withSource(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        int $amount,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        string $description,
        ?string $routeID,
        RouteType|string|null $routeType,
        Source|array $source,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['description'] = $description;
        $self['routeID'] = $routeID;
        $self['routeType'] = $routeType;
        $self['source'] = $source;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Transaction identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account the Transaction belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Transaction amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Transaction occurred.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Transaction's currency. This will match the currency on the Transaction's Account.
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
     * An informational message describing this transaction. Use the fields in `source` to get more detailed information. This field appears as the line-item on the statement.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier for the route this Transaction came through. Routes are things like cards and ACH details.
     */
    public function withRouteID(?string $routeID): self
    {
        $self = clone $this;
        $self['routeID'] = $routeID;

        return $self;
    }

    /**
     * The type of the route this Transaction came through.
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
     * This is an object giving more details on the network-level event that caused the Transaction. Note that for backwards compatibility reasons, additional undocumented keys may appear in this object. These should be treated as deprecated and will be removed in the future.
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
     * A constant representing the object's type. For this resource it will always be `transaction`.
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

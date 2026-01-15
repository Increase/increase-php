<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Currency;
use Increase\DeclinedTransactions\DeclinedTransaction\RouteType;
use Increase\DeclinedTransactions\DeclinedTransaction\Source;
use Increase\DeclinedTransactions\DeclinedTransaction\Type;

/**
 * Declined Transactions are refused additions and removals of money from your bank account. For example, Declined Transactions are caused when your Account has an insufficient balance or your Limits are triggered.
 *
 * @phpstan-import-type SourceShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source
 *
 * @phpstan-type DeclinedTransactionShape = array{
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
final class DeclinedTransaction implements BaseModel
{
    /** @use SdkModel<DeclinedTransactionShape> */
    use SdkModel;

    /**
     * The Declined Transaction identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account the Declined Transaction belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Declined Transaction amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which the Transaction occurred.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Declined Transaction's currency. This will match the currency on the Declined Transaction's Account.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * This is the description the vendor provides.
     */
    #[Required]
    public string $description;

    /**
     * The identifier for the route this Declined Transaction came through. Routes are things like cards and ACH details.
     */
    #[Required('route_id')]
    public ?string $routeID;

    /**
     * The type of the route this Declined Transaction came through.
     *
     * @var value-of<RouteType>|null $routeType
     */
    #[Required('route_type', enum: RouteType::class)]
    public ?string $routeType;

    /**
     * This is an object giving more details on the network-level event that caused the Declined Transaction. For example, for a card transaction this lists the merchant's industry and location. Note that for backwards compatibility reasons, additional undocumented keys may appear in this object. These should be treated as deprecated and will be removed in the future.
     */
    #[Required]
    public Source $source;

    /**
     * A constant representing the object's type. For this resource it will always be `declined_transaction`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new DeclinedTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeclinedTransaction::with(
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
     * (new DeclinedTransaction)
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
     * The Declined Transaction identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account the Declined Transaction belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Declined Transaction amount in the minor unit of its currency. For dollars, for example, this is cents.
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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Declined Transaction's currency. This will match the currency on the Declined Transaction's Account.
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
     * This is the description the vendor provides.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier for the route this Declined Transaction came through. Routes are things like cards and ACH details.
     */
    public function withRouteID(?string $routeID): self
    {
        $self = clone $this;
        $self['routeID'] = $routeID;

        return $self;
    }

    /**
     * The type of the route this Declined Transaction came through.
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
     * This is an object giving more details on the network-level event that caused the Declined Transaction. For example, for a card transaction this lists the merchant's industry and location. Note that for backwards compatibility reasons, additional undocumented keys may appear in this object. These should be treated as deprecated and will be removed in the future.
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
     * A constant representing the object's type. For this resource it will always be `declined_transaction`.
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

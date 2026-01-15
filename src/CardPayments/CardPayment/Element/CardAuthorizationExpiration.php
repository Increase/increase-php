<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardAuthorizationExpiration\Currency;
use Increase\CardPayments\CardPayment\Element\CardAuthorizationExpiration\Network;
use Increase\CardPayments\CardPayment\Element\CardAuthorizationExpiration\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Authorization Expiration object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization_expiration`. Card Authorization Expirations are cancellations of authorizations that were never settled by the acquirer.
 *
 * @phpstan-type CardAuthorizationExpirationShape = array{
 *   id: string,
 *   cardAuthorizationID: string,
 *   currency: Currency|value-of<Currency>,
 *   expiredAmount: int,
 *   network: Network|value-of<Network>,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardAuthorizationExpiration implements BaseModel
{
    /** @use SdkModel<CardAuthorizationExpirationShape> */
    use SdkModel;

    /**
     * The Card Authorization Expiration identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Card Authorization this reverses.
     */
    #[Required('card_authorization_id')]
    public string $cardAuthorizationID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the reversal's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The amount of this authorization expiration in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('expired_amount')]
    public int $expiredAmount;

    /**
     * The card network used to process this card authorization.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * A constant representing the object's type. For this resource it will always be `card_authorization_expiration`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardAuthorizationExpiration()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthorizationExpiration::with(
     *   id: ...,
     *   cardAuthorizationID: ...,
     *   currency: ...,
     *   expiredAmount: ...,
     *   network: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthorizationExpiration)
     *   ->withID(...)
     *   ->withCardAuthorizationID(...)
     *   ->withCurrency(...)
     *   ->withExpiredAmount(...)
     *   ->withNetwork(...)
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
     * @param Network|value-of<Network> $network
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $cardAuthorizationID,
        Currency|string $currency,
        int $expiredAmount,
        Network|string $network,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardAuthorizationID'] = $cardAuthorizationID;
        $self['currency'] = $currency;
        $self['expiredAmount'] = $expiredAmount;
        $self['network'] = $network;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Authorization Expiration identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Card Authorization this reverses.
     */
    public function withCardAuthorizationID(string $cardAuthorizationID): self
    {
        $self = clone $this;
        $self['cardAuthorizationID'] = $cardAuthorizationID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the reversal's currency.
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
     * The amount of this authorization expiration in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withExpiredAmount(int $expiredAmount): self
    {
        $self = clone $this;
        $self['expiredAmount'] = $expiredAmount;

        return $self;
    }

    /**
     * The card network used to process this card authorization.
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
     * A constant representing the object's type. For this resource it will always be `card_authorization_expiration`.
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

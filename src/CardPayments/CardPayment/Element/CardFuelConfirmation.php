<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardFuelConfirmation\Currency;
use Increase\CardPayments\CardPayment\Element\CardFuelConfirmation\Network;
use Increase\CardPayments\CardPayment\Element\CardFuelConfirmation\NetworkIdentifiers;
use Increase\CardPayments\CardPayment\Element\CardFuelConfirmation\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Fuel Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `card_fuel_confirmation`. Card Fuel Confirmations update the amount of a Card Authorization after a fuel pump transaction is completed.
 *
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\CardPayments\CardPayment\Element\CardFuelConfirmation\NetworkIdentifiers
 *
 * @phpstan-type CardFuelConfirmationShape = array{
 *   id: string,
 *   cardAuthorizationID: string,
 *   currency: Currency|value-of<Currency>,
 *   network: Network|value-of<Network>,
 *   networkIdentifiers: NetworkIdentifiers|NetworkIdentifiersShape,
 *   pendingTransactionID: string|null,
 *   type: Type|value-of<Type>,
 *   updatedAuthorizationAmount: int,
 * }
 */
final class CardFuelConfirmation implements BaseModel
{
    /** @use SdkModel<CardFuelConfirmationShape> */
    use SdkModel;

    /**
     * The Card Fuel Confirmation identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Card Authorization this updates.
     */
    #[Required('card_authorization_id')]
    public string $cardAuthorizationID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the increment's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The card network used to process this card authorization.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * Network-specific identifiers for a specific request or transaction.
     */
    #[Required('network_identifiers')]
    public NetworkIdentifiers $networkIdentifiers;

    /**
     * The identifier of the Pending Transaction associated with this Card Fuel Confirmation.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `card_fuel_confirmation`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The updated authorization amount after this fuel confirmation, in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('updated_authorization_amount')]
    public int $updatedAuthorizationAmount;

    /**
     * `new CardFuelConfirmation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardFuelConfirmation::with(
     *   id: ...,
     *   cardAuthorizationID: ...,
     *   currency: ...,
     *   network: ...,
     *   networkIdentifiers: ...,
     *   pendingTransactionID: ...,
     *   type: ...,
     *   updatedAuthorizationAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardFuelConfirmation)
     *   ->withID(...)
     *   ->withCardAuthorizationID(...)
     *   ->withCurrency(...)
     *   ->withNetwork(...)
     *   ->withNetworkIdentifiers(...)
     *   ->withPendingTransactionID(...)
     *   ->withType(...)
     *   ->withUpdatedAuthorizationAmount(...)
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
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $cardAuthorizationID,
        Currency|string $currency,
        Network|string $network,
        NetworkIdentifiers|array $networkIdentifiers,
        ?string $pendingTransactionID,
        Type|string $type,
        int $updatedAuthorizationAmount,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardAuthorizationID'] = $cardAuthorizationID;
        $self['currency'] = $currency;
        $self['network'] = $network;
        $self['networkIdentifiers'] = $networkIdentifiers;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['type'] = $type;
        $self['updatedAuthorizationAmount'] = $updatedAuthorizationAmount;

        return $self;
    }

    /**
     * The Card Fuel Confirmation identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Card Authorization this updates.
     */
    public function withCardAuthorizationID(string $cardAuthorizationID): self
    {
        $self = clone $this;
        $self['cardAuthorizationID'] = $cardAuthorizationID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the increment's currency.
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
     * Network-specific identifiers for a specific request or transaction.
     *
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     */
    public function withNetworkIdentifiers(
        NetworkIdentifiers|array $networkIdentifiers
    ): self {
        $self = clone $this;
        $self['networkIdentifiers'] = $networkIdentifiers;

        return $self;
    }

    /**
     * The identifier of the Pending Transaction associated with this Card Fuel Confirmation.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_fuel_confirmation`.
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
     * The updated authorization amount after this fuel confirmation, in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withUpdatedAuthorizationAmount(
        int $updatedAuthorizationAmount
    ): self {
        $self = clone $this;
        $self['updatedAuthorizationAmount'] = $updatedAuthorizationAmount;

        return $self;
    }
}

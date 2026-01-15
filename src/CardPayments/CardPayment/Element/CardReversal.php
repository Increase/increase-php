<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardReversal\Currency;
use Increase\CardPayments\CardPayment\Element\CardReversal\Network;
use Increase\CardPayments\CardPayment\Element\CardReversal\NetworkIdentifiers;
use Increase\CardPayments\CardPayment\Element\CardReversal\ReversalReason;
use Increase\CardPayments\CardPayment\Element\CardReversal\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Reversal object. This field will be present in the JSON response if and only if `category` is equal to `card_reversal`. Card Reversals cancel parts of or the entirety of an existing Card Authorization.
 *
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\CardPayments\CardPayment\Element\CardReversal\NetworkIdentifiers
 *
 * @phpstan-type CardReversalShape = array{
 *   id: string,
 *   cardAuthorizationID: string,
 *   currency: Currency|value-of<Currency>,
 *   merchantAcceptorID: string,
 *   merchantCategoryCode: string,
 *   merchantCity: string|null,
 *   merchantCountry: string|null,
 *   merchantDescriptor: string,
 *   merchantPostalCode: string|null,
 *   merchantState: string|null,
 *   network: Network|value-of<Network>,
 *   networkIdentifiers: NetworkIdentifiers|NetworkIdentifiersShape,
 *   pendingTransactionID: string|null,
 *   presentmentCurrency: string,
 *   reversalAmount: int,
 *   reversalPresentmentAmount: int,
 *   reversalReason: null|ReversalReason|value-of<ReversalReason>,
 *   terminalID: string|null,
 *   type: Type|value-of<Type>,
 *   updatedAuthorizationAmount: int,
 *   updatedAuthorizationPresentmentAmount: int,
 * }
 */
final class CardReversal implements BaseModel
{
    /** @use SdkModel<CardReversalShape> */
    use SdkModel;

    /**
     * The Card Reversal identifier.
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
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    #[Required('merchant_acceptor_id')]
    public string $merchantAcceptorID;

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    #[Required('merchant_category_code')]
    public string $merchantCategoryCode;

    /**
     * The city the merchant resides in.
     */
    #[Required('merchant_city')]
    public ?string $merchantCity;

    /**
     * The country the merchant resides in.
     */
    #[Required('merchant_country')]
    public ?string $merchantCountry;

    /**
     * The merchant descriptor of the merchant the card is transacting with.
     */
    #[Required('merchant_descriptor')]
    public string $merchantDescriptor;

    /**
     * The merchant's postal code. For US merchants this is either a 5-digit or 9-digit ZIP code, where the first 5 and last 4 are separated by a dash.
     */
    #[Required('merchant_postal_code')]
    public ?string $merchantPostalCode;

    /**
     * The state the merchant resides in.
     */
    #[Required('merchant_state')]
    public ?string $merchantState;

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
     * The identifier of the Pending Transaction associated with this Card Reversal.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the reversal's presentment currency.
     */
    #[Required('presentment_currency')]
    public string $presentmentCurrency;

    /**
     * The amount of this reversal in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('reversal_amount')]
    public int $reversalAmount;

    /**
     * The amount of this reversal in the minor unit of the transaction's presentment currency. For dollars, for example, this is cents.
     */
    #[Required('reversal_presentment_amount')]
    public int $reversalPresentmentAmount;

    /**
     * Why this reversal was initiated.
     *
     * @var value-of<ReversalReason>|null $reversalReason
     */
    #[Required('reversal_reason', enum: ReversalReason::class)]
    public ?string $reversalReason;

    /**
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    #[Required('terminal_id')]
    public ?string $terminalID;

    /**
     * A constant representing the object's type. For this resource it will always be `card_reversal`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The amount left pending on the Card Authorization in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('updated_authorization_amount')]
    public int $updatedAuthorizationAmount;

    /**
     * The amount left pending on the Card Authorization in the minor unit of the transaction's presentment currency. For dollars, for example, this is cents.
     */
    #[Required('updated_authorization_presentment_amount')]
    public int $updatedAuthorizationPresentmentAmount;

    /**
     * `new CardReversal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardReversal::with(
     *   id: ...,
     *   cardAuthorizationID: ...,
     *   currency: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCity: ...,
     *   merchantCountry: ...,
     *   merchantDescriptor: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     *   network: ...,
     *   networkIdentifiers: ...,
     *   pendingTransactionID: ...,
     *   presentmentCurrency: ...,
     *   reversalAmount: ...,
     *   reversalPresentmentAmount: ...,
     *   reversalReason: ...,
     *   terminalID: ...,
     *   type: ...,
     *   updatedAuthorizationAmount: ...,
     *   updatedAuthorizationPresentmentAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardReversal)
     *   ->withID(...)
     *   ->withCardAuthorizationID(...)
     *   ->withCurrency(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCity(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantDescriptor(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
     *   ->withNetwork(...)
     *   ->withNetworkIdentifiers(...)
     *   ->withPendingTransactionID(...)
     *   ->withPresentmentCurrency(...)
     *   ->withReversalAmount(...)
     *   ->withReversalPresentmentAmount(...)
     *   ->withReversalReason(...)
     *   ->withTerminalID(...)
     *   ->withType(...)
     *   ->withUpdatedAuthorizationAmount(...)
     *   ->withUpdatedAuthorizationPresentmentAmount(...)
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
     * @param ReversalReason|value-of<ReversalReason>|null $reversalReason
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $cardAuthorizationID,
        Currency|string $currency,
        string $merchantAcceptorID,
        string $merchantCategoryCode,
        ?string $merchantCity,
        ?string $merchantCountry,
        string $merchantDescriptor,
        ?string $merchantPostalCode,
        ?string $merchantState,
        Network|string $network,
        NetworkIdentifiers|array $networkIdentifiers,
        ?string $pendingTransactionID,
        string $presentmentCurrency,
        int $reversalAmount,
        int $reversalPresentmentAmount,
        ReversalReason|string|null $reversalReason,
        ?string $terminalID,
        Type|string $type,
        int $updatedAuthorizationAmount,
        int $updatedAuthorizationPresentmentAmount,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardAuthorizationID'] = $cardAuthorizationID;
        $self['currency'] = $currency;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCity'] = $merchantCity;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantDescriptor'] = $merchantDescriptor;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;
        $self['network'] = $network;
        $self['networkIdentifiers'] = $networkIdentifiers;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['presentmentCurrency'] = $presentmentCurrency;
        $self['reversalAmount'] = $reversalAmount;
        $self['reversalPresentmentAmount'] = $reversalPresentmentAmount;
        $self['reversalReason'] = $reversalReason;
        $self['terminalID'] = $terminalID;
        $self['type'] = $type;
        $self['updatedAuthorizationAmount'] = $updatedAuthorizationAmount;
        $self['updatedAuthorizationPresentmentAmount'] = $updatedAuthorizationPresentmentAmount;

        return $self;
    }

    /**
     * The Card Reversal identifier.
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
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    public function withMerchantAcceptorID(string $merchantAcceptorID): self
    {
        $self = clone $this;
        $self['merchantAcceptorID'] = $merchantAcceptorID;

        return $self;
    }

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    public function withMerchantCategoryCode(string $merchantCategoryCode): self
    {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The city the merchant resides in.
     */
    public function withMerchantCity(?string $merchantCity): self
    {
        $self = clone $this;
        $self['merchantCity'] = $merchantCity;

        return $self;
    }

    /**
     * The country the merchant resides in.
     */
    public function withMerchantCountry(?string $merchantCountry): self
    {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * The merchant descriptor of the merchant the card is transacting with.
     */
    public function withMerchantDescriptor(string $merchantDescriptor): self
    {
        $self = clone $this;
        $self['merchantDescriptor'] = $merchantDescriptor;

        return $self;
    }

    /**
     * The merchant's postal code. For US merchants this is either a 5-digit or 9-digit ZIP code, where the first 5 and last 4 are separated by a dash.
     */
    public function withMerchantPostalCode(?string $merchantPostalCode): self
    {
        $self = clone $this;
        $self['merchantPostalCode'] = $merchantPostalCode;

        return $self;
    }

    /**
     * The state the merchant resides in.
     */
    public function withMerchantState(?string $merchantState): self
    {
        $self = clone $this;
        $self['merchantState'] = $merchantState;

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
     * The identifier of the Pending Transaction associated with this Card Reversal.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the reversal's presentment currency.
     */
    public function withPresentmentCurrency(string $presentmentCurrency): self
    {
        $self = clone $this;
        $self['presentmentCurrency'] = $presentmentCurrency;

        return $self;
    }

    /**
     * The amount of this reversal in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withReversalAmount(int $reversalAmount): self
    {
        $self = clone $this;
        $self['reversalAmount'] = $reversalAmount;

        return $self;
    }

    /**
     * The amount of this reversal in the minor unit of the transaction's presentment currency. For dollars, for example, this is cents.
     */
    public function withReversalPresentmentAmount(
        int $reversalPresentmentAmount
    ): self {
        $self = clone $this;
        $self['reversalPresentmentAmount'] = $reversalPresentmentAmount;

        return $self;
    }

    /**
     * Why this reversal was initiated.
     *
     * @param ReversalReason|value-of<ReversalReason>|null $reversalReason
     */
    public function withReversalReason(
        ReversalReason|string|null $reversalReason
    ): self {
        $self = clone $this;
        $self['reversalReason'] = $reversalReason;

        return $self;
    }

    /**
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    public function withTerminalID(?string $terminalID): self
    {
        $self = clone $this;
        $self['terminalID'] = $terminalID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_reversal`.
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
     * The amount left pending on the Card Authorization in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withUpdatedAuthorizationAmount(
        int $updatedAuthorizationAmount
    ): self {
        $self = clone $this;
        $self['updatedAuthorizationAmount'] = $updatedAuthorizationAmount;

        return $self;
    }

    /**
     * The amount left pending on the Card Authorization in the minor unit of the transaction's presentment currency. For dollars, for example, this is cents.
     */
    public function withUpdatedAuthorizationPresentmentAmount(
        int $updatedAuthorizationPresentmentAmount
    ): self {
        $self = clone $this;
        $self['updatedAuthorizationPresentmentAmount'] = $updatedAuthorizationPresentmentAmount;

        return $self;
    }
}

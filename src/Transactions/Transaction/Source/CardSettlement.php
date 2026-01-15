<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardSettlement\Cashback;
use Increase\Transactions\Transaction\Source\CardSettlement\Currency;
use Increase\Transactions\Transaction\Source\CardSettlement\Interchange;
use Increase\Transactions\Transaction\Source\CardSettlement\Network;
use Increase\Transactions\Transaction\Source\CardSettlement\NetworkIdentifiers;
use Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails;
use Increase\Transactions\Transaction\Source\CardSettlement\Surcharge;
use Increase\Transactions\Transaction\Source\CardSettlement\Type;

/**
 * A Card Settlement object. This field will be present in the JSON response if and only if `category` is equal to `card_settlement`. Card Settlements are card transactions that have cleared and settled. While a settlement is usually preceded by an authorization, an acquirer can also directly clear a transaction without first authorizing it.
 *
 * @phpstan-import-type CashbackShape from \Increase\Transactions\Transaction\Source\CardSettlement\Cashback
 * @phpstan-import-type InterchangeShape from \Increase\Transactions\Transaction\Source\CardSettlement\Interchange
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\Transactions\Transaction\Source\CardSettlement\NetworkIdentifiers
 * @phpstan-import-type PurchaseDetailsShape from \Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails
 * @phpstan-import-type SurchargeShape from \Increase\Transactions\Transaction\Source\CardSettlement\Surcharge
 *
 * @phpstan-type CardSettlementShape = array{
 *   id: string,
 *   amount: int,
 *   cardAuthorization: string|null,
 *   cardPaymentID: string,
 *   cashback: null|Cashback|CashbackShape,
 *   currency: Currency|value-of<Currency>,
 *   interchange: null|Interchange|InterchangeShape,
 *   merchantAcceptorID: string,
 *   merchantCategoryCode: string,
 *   merchantCity: string,
 *   merchantCountry: string,
 *   merchantName: string,
 *   merchantPostalCode: string|null,
 *   merchantState: string|null,
 *   network: Network|value-of<Network>,
 *   networkIdentifiers: NetworkIdentifiers|NetworkIdentifiersShape,
 *   pendingTransactionID: string|null,
 *   presentmentAmount: int,
 *   presentmentCurrency: string,
 *   purchaseDetails: null|PurchaseDetails|PurchaseDetailsShape,
 *   surcharge: null|Surcharge|SurchargeShape,
 *   transactionID: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardSettlement implements BaseModel
{
    /** @use SdkModel<CardSettlementShape> */
    use SdkModel;

    /**
     * The Card Settlement identifier.
     */
    #[Required]
    public string $id;

    /**
     * The amount in the minor unit of the transaction's settlement currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The Card Authorization that was created prior to this Card Settlement, if one exists.
     */
    #[Required('card_authorization')]
    public ?string $cardAuthorization;

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * Cashback earned on this transaction, if eligible. Cashback is paid out in aggregate, monthly.
     */
    #[Required]
    public ?Cashback $cashback;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's settlement currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Interchange assessed as a part of this transaction.
     */
    #[Required]
    public ?Interchange $interchange;

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    #[Required('merchant_acceptor_id')]
    public string $merchantAcceptorID;

    /**
     * The 4-digit MCC describing the merchant's business.
     */
    #[Required('merchant_category_code')]
    public string $merchantCategoryCode;

    /**
     * The city the merchant resides in.
     */
    #[Required('merchant_city')]
    public string $merchantCity;

    /**
     * The country the merchant resides in.
     */
    #[Required('merchant_country')]
    public string $merchantCountry;

    /**
     * The name of the merchant.
     */
    #[Required('merchant_name')]
    public string $merchantName;

    /**
     * The merchant's postal code. For US merchants this is always a 5-digit ZIP code.
     */
    #[Required('merchant_postal_code')]
    public ?string $merchantPostalCode;

    /**
     * The state the merchant resides in.
     */
    #[Required('merchant_state')]
    public ?string $merchantState;

    /**
     * The card network on which this transaction was processed.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * Network-specific identifiers for this refund.
     */
    #[Required('network_identifiers')]
    public NetworkIdentifiers $networkIdentifiers;

    /**
     * The identifier of the Pending Transaction associated with this Transaction.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * The amount in the minor unit of the transaction's presentment currency.
     */
    #[Required('presentment_amount')]
    public int $presentmentAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's presentment currency.
     */
    #[Required('presentment_currency')]
    public string $presentmentCurrency;

    /**
     * Additional details about the card purchase, such as tax and industry-specific fields.
     */
    #[Required('purchase_details')]
    public ?PurchaseDetails $purchaseDetails;

    /**
     * Surcharge amount details, if applicable. The amount is positive if the surcharge is added to to the overall transaction amount (surcharge), and negative if the surcharge is deducted from the overall transaction amount (discount).
     */
    #[Required]
    public ?Surcharge $surcharge;

    /**
     * The identifier of the Transaction associated with this Transaction.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `card_settlement`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardSettlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardSettlement::with(
     *   id: ...,
     *   amount: ...,
     *   cardAuthorization: ...,
     *   cardPaymentID: ...,
     *   cashback: ...,
     *   currency: ...,
     *   interchange: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCity: ...,
     *   merchantCountry: ...,
     *   merchantName: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     *   network: ...,
     *   networkIdentifiers: ...,
     *   pendingTransactionID: ...,
     *   presentmentAmount: ...,
     *   presentmentCurrency: ...,
     *   purchaseDetails: ...,
     *   surcharge: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardSettlement)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCardAuthorization(...)
     *   ->withCardPaymentID(...)
     *   ->withCashback(...)
     *   ->withCurrency(...)
     *   ->withInterchange(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCity(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantName(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
     *   ->withNetwork(...)
     *   ->withNetworkIdentifiers(...)
     *   ->withPendingTransactionID(...)
     *   ->withPresentmentAmount(...)
     *   ->withPresentmentCurrency(...)
     *   ->withPurchaseDetails(...)
     *   ->withSurcharge(...)
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
     * @param Cashback|CashbackShape|null $cashback
     * @param Currency|value-of<Currency> $currency
     * @param Interchange|InterchangeShape|null $interchange
     * @param Network|value-of<Network> $network
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param PurchaseDetails|PurchaseDetailsShape|null $purchaseDetails
     * @param Surcharge|SurchargeShape|null $surcharge
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        int $amount,
        ?string $cardAuthorization,
        string $cardPaymentID,
        Cashback|array|null $cashback,
        Currency|string $currency,
        Interchange|array|null $interchange,
        string $merchantAcceptorID,
        string $merchantCategoryCode,
        string $merchantCity,
        string $merchantCountry,
        string $merchantName,
        ?string $merchantPostalCode,
        ?string $merchantState,
        Network|string $network,
        NetworkIdentifiers|array $networkIdentifiers,
        ?string $pendingTransactionID,
        int $presentmentAmount,
        string $presentmentCurrency,
        PurchaseDetails|array|null $purchaseDetails,
        Surcharge|array|null $surcharge,
        string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['cardAuthorization'] = $cardAuthorization;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['cashback'] = $cashback;
        $self['currency'] = $currency;
        $self['interchange'] = $interchange;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCity'] = $merchantCity;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantName'] = $merchantName;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;
        $self['network'] = $network;
        $self['networkIdentifiers'] = $networkIdentifiers;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['presentmentAmount'] = $presentmentAmount;
        $self['presentmentCurrency'] = $presentmentCurrency;
        $self['purchaseDetails'] = $purchaseDetails;
        $self['surcharge'] = $surcharge;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Settlement identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The amount in the minor unit of the transaction's settlement currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The Card Authorization that was created prior to this Card Settlement, if one exists.
     */
    public function withCardAuthorization(?string $cardAuthorization): self
    {
        $self = clone $this;
        $self['cardAuthorization'] = $cardAuthorization;

        return $self;
    }

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * Cashback earned on this transaction, if eligible. Cashback is paid out in aggregate, monthly.
     *
     * @param Cashback|CashbackShape|null $cashback
     */
    public function withCashback(Cashback|array|null $cashback): self
    {
        $self = clone $this;
        $self['cashback'] = $cashback;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's settlement currency.
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
     * Interchange assessed as a part of this transaction.
     *
     * @param Interchange|InterchangeShape|null $interchange
     */
    public function withInterchange(Interchange|array|null $interchange): self
    {
        $self = clone $this;
        $self['interchange'] = $interchange;

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
     * The 4-digit MCC describing the merchant's business.
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
    public function withMerchantCity(string $merchantCity): self
    {
        $self = clone $this;
        $self['merchantCity'] = $merchantCity;

        return $self;
    }

    /**
     * The country the merchant resides in.
     */
    public function withMerchantCountry(string $merchantCountry): self
    {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * The name of the merchant.
     */
    public function withMerchantName(string $merchantName): self
    {
        $self = clone $this;
        $self['merchantName'] = $merchantName;

        return $self;
    }

    /**
     * The merchant's postal code. For US merchants this is always a 5-digit ZIP code.
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
     * The card network on which this transaction was processed.
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
     * Network-specific identifiers for this refund.
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
     * The identifier of the Pending Transaction associated with this Transaction.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * The amount in the minor unit of the transaction's presentment currency.
     */
    public function withPresentmentAmount(int $presentmentAmount): self
    {
        $self = clone $this;
        $self['presentmentAmount'] = $presentmentAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's presentment currency.
     */
    public function withPresentmentCurrency(string $presentmentCurrency): self
    {
        $self = clone $this;
        $self['presentmentCurrency'] = $presentmentCurrency;

        return $self;
    }

    /**
     * Additional details about the card purchase, such as tax and industry-specific fields.
     *
     * @param PurchaseDetails|PurchaseDetailsShape|null $purchaseDetails
     */
    public function withPurchaseDetails(
        PurchaseDetails|array|null $purchaseDetails
    ): self {
        $self = clone $this;
        $self['purchaseDetails'] = $purchaseDetails;

        return $self;
    }

    /**
     * Surcharge amount details, if applicable. The amount is positive if the surcharge is added to to the overall transaction amount (surcharge), and negative if the surcharge is deducted from the overall transaction amount (discount).
     *
     * @param Surcharge|SurchargeShape|null $surcharge
     */
    public function withSurcharge(Surcharge|array|null $surcharge): self
    {
        $self = clone $this;
        $self['surcharge'] = $surcharge;

        return $self;
    }

    /**
     * The identifier of the Transaction associated with this Transaction.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_settlement`.
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

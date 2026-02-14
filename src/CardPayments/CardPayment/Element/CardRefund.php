<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardRefund\Cashback;
use Increase\CardPayments\CardPayment\Element\CardRefund\Currency;
use Increase\CardPayments\CardPayment\Element\CardRefund\Interchange;
use Increase\CardPayments\CardPayment\Element\CardRefund\NetworkIdentifiers;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails;
use Increase\CardPayments\CardPayment\Element\CardRefund\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Refund object. This field will be present in the JSON response if and only if `category` is equal to `card_refund`. Card Refunds move money back to the cardholder. While they are usually connected to a Card Settlement, an acquirer can also refund money directly to a card without relation to a transaction.
 *
 * @phpstan-import-type CashbackShape from \Increase\CardPayments\CardPayment\Element\CardRefund\Cashback
 * @phpstan-import-type InterchangeShape from \Increase\CardPayments\CardPayment\Element\CardRefund\Interchange
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\CardPayments\CardPayment\Element\CardRefund\NetworkIdentifiers
 * @phpstan-import-type PurchaseDetailsShape from \Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails
 *
 * @phpstan-type CardRefundShape = array{
 *   id: string,
 *   amount: int,
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
 *   networkIdentifiers: NetworkIdentifiers|NetworkIdentifiersShape,
 *   presentmentAmount: int,
 *   presentmentCurrency: string,
 *   purchaseDetails: null|PurchaseDetails|PurchaseDetailsShape,
 *   transactionID: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardRefund implements BaseModel
{
    /** @use SdkModel<CardRefundShape> */
    use SdkModel;

    /**
     * The Card Refund identifier.
     */
    #[Required]
    public string $id;

    /**
     * The amount in the minor unit of the transaction's settlement currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * Cashback debited for this transaction, if eligible. Cashback is paid out in aggregate, monthly.
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
     * Network-specific identifiers for this refund.
     */
    #[Required('network_identifiers')]
    public NetworkIdentifiers $networkIdentifiers;

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
     * The identifier of the Transaction associated with this Transaction.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `card_refund`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardRefund()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardRefund::with(
     *   id: ...,
     *   amount: ...,
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
     *   networkIdentifiers: ...,
     *   presentmentAmount: ...,
     *   presentmentCurrency: ...,
     *   purchaseDetails: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardRefund)
     *   ->withID(...)
     *   ->withAmount(...)
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
     *   ->withNetworkIdentifiers(...)
     *   ->withPresentmentAmount(...)
     *   ->withPresentmentCurrency(...)
     *   ->withPurchaseDetails(...)
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
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param PurchaseDetails|PurchaseDetailsShape|null $purchaseDetails
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        int $amount,
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
        NetworkIdentifiers|array $networkIdentifiers,
        int $presentmentAmount,
        string $presentmentCurrency,
        PurchaseDetails|array|null $purchaseDetails,
        string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
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
        $self['networkIdentifiers'] = $networkIdentifiers;
        $self['presentmentAmount'] = $presentmentAmount;
        $self['presentmentCurrency'] = $presentmentCurrency;
        $self['purchaseDetails'] = $purchaseDetails;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Refund identifier.
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
     * The ID of the Card Payment this transaction belongs to.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * Cashback debited for this transaction, if eligible. Cashback is paid out in aggregate, monthly.
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
     * The identifier of the Transaction associated with this Transaction.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_refund`.
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

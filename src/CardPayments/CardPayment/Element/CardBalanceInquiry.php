<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\Currency;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\NetworkDetails;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\NetworkIdentifiers;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\Type;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\Verification;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Balance Inquiry object. This field will be present in the JSON response if and only if `category` is equal to `card_balance_inquiry`. Card Balance Inquiries are transactions that allow merchants to check the available balance on a card without placing a hold on funds, commonly used when a customer requests their balance at an ATM.
 *
 * @phpstan-import-type AdditionalAmountsShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts
 * @phpstan-import-type NetworkDetailsShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\NetworkDetails
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\NetworkIdentifiers
 * @phpstan-import-type VerificationShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\Verification
 *
 * @phpstan-type CardBalanceInquiryShape = array{
 *   id: string,
 *   additionalAmounts: AdditionalAmounts|AdditionalAmountsShape,
 *   balance: int,
 *   cardPaymentID: string,
 *   currency: Currency|value-of<Currency>,
 *   digitalWalletTokenID: string|null,
 *   merchantAcceptorID: string,
 *   merchantCategoryCode: string,
 *   merchantCity: string|null,
 *   merchantCountry: string,
 *   merchantDescriptor: string,
 *   merchantPostalCode: string|null,
 *   merchantState: string|null,
 *   networkDetails: NetworkDetails|NetworkDetailsShape,
 *   networkIdentifiers: NetworkIdentifiers|NetworkIdentifiersShape,
 *   networkRiskScore: int|null,
 *   physicalCardID: string|null,
 *   realTimeDecisionID: string|null,
 *   terminalID: string|null,
 *   type: Type|value-of<Type>,
 *   verification: Verification|VerificationShape,
 * }
 */
final class CardBalanceInquiry implements BaseModel
{
    /** @use SdkModel<CardBalanceInquiryShape> */
    use SdkModel;

    /**
     * The Card Balance Inquiry identifier.
     */
    #[Required]
    public string $id;

    /**
     * Additional amounts associated with the card authorization, such as ATM surcharges fees. These are usually a subset of the `amount` field and are used to provide more detailed information about the transaction.
     */
    #[Required('additional_amounts')]
    public AdditionalAmounts $additionalAmounts;

    /**
     * The balance amount in the minor unit of the account's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $balance;

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the account's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * If the authorization was made via a Digital Wallet Token (such as an Apple Pay purchase), the identifier of the token that was used.
     */
    #[Required('digital_wallet_token_id')]
    public ?string $digitalWalletTokenID;

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
    public string $merchantCountry;

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
     * Fields specific to the `network`.
     */
    #[Required('network_details')]
    public NetworkDetails $networkDetails;

    /**
     * Network-specific identifiers for a specific request or transaction.
     */
    #[Required('network_identifiers')]
    public NetworkIdentifiers $networkIdentifiers;

    /**
     * The risk score generated by the card network. For Visa this is the Visa Advanced Authorization risk score, from 0 to 99, where 99 is the riskiest. For Pulse the score is from 0 to 999, where 999 is the riskiest.
     */
    #[Required('network_risk_score')]
    public ?int $networkRiskScore;

    /**
     * If the authorization was made in-person with a physical card, the Physical Card that was used.
     */
    #[Required('physical_card_id')]
    public ?string $physicalCardID;

    /**
     * The identifier of the Real-Time Decision sent to approve or decline this transaction.
     */
    #[Required('real_time_decision_id')]
    public ?string $realTimeDecisionID;

    /**
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    #[Required('terminal_id')]
    public ?string $terminalID;

    /**
     * A constant representing the object's type. For this resource it will always be `card_balance_inquiry`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Fields related to verification of cardholder-provided values.
     */
    #[Required]
    public Verification $verification;

    /**
     * `new CardBalanceInquiry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardBalanceInquiry::with(
     *   id: ...,
     *   additionalAmounts: ...,
     *   balance: ...,
     *   cardPaymentID: ...,
     *   currency: ...,
     *   digitalWalletTokenID: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCity: ...,
     *   merchantCountry: ...,
     *   merchantDescriptor: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     *   networkDetails: ...,
     *   networkIdentifiers: ...,
     *   networkRiskScore: ...,
     *   physicalCardID: ...,
     *   realTimeDecisionID: ...,
     *   terminalID: ...,
     *   type: ...,
     *   verification: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardBalanceInquiry)
     *   ->withID(...)
     *   ->withAdditionalAmounts(...)
     *   ->withBalance(...)
     *   ->withCardPaymentID(...)
     *   ->withCurrency(...)
     *   ->withDigitalWalletTokenID(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCity(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantDescriptor(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
     *   ->withNetworkDetails(...)
     *   ->withNetworkIdentifiers(...)
     *   ->withNetworkRiskScore(...)
     *   ->withPhysicalCardID(...)
     *   ->withRealTimeDecisionID(...)
     *   ->withTerminalID(...)
     *   ->withType(...)
     *   ->withVerification(...)
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
     * @param AdditionalAmounts|AdditionalAmountsShape $additionalAmounts
     * @param Currency|value-of<Currency> $currency
     * @param NetworkDetails|NetworkDetailsShape $networkDetails
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param Type|value-of<Type> $type
     * @param Verification|VerificationShape $verification
     */
    public static function with(
        string $id,
        AdditionalAmounts|array $additionalAmounts,
        int $balance,
        string $cardPaymentID,
        Currency|string $currency,
        ?string $digitalWalletTokenID,
        string $merchantAcceptorID,
        string $merchantCategoryCode,
        ?string $merchantCity,
        string $merchantCountry,
        string $merchantDescriptor,
        ?string $merchantPostalCode,
        ?string $merchantState,
        NetworkDetails|array $networkDetails,
        NetworkIdentifiers|array $networkIdentifiers,
        ?int $networkRiskScore,
        ?string $physicalCardID,
        ?string $realTimeDecisionID,
        ?string $terminalID,
        Type|string $type,
        Verification|array $verification,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['additionalAmounts'] = $additionalAmounts;
        $self['balance'] = $balance;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['currency'] = $currency;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCity'] = $merchantCity;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantDescriptor'] = $merchantDescriptor;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;
        $self['networkDetails'] = $networkDetails;
        $self['networkIdentifiers'] = $networkIdentifiers;
        $self['networkRiskScore'] = $networkRiskScore;
        $self['physicalCardID'] = $physicalCardID;
        $self['realTimeDecisionID'] = $realTimeDecisionID;
        $self['terminalID'] = $terminalID;
        $self['type'] = $type;
        $self['verification'] = $verification;

        return $self;
    }

    /**
     * The Card Balance Inquiry identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Additional amounts associated with the card authorization, such as ATM surcharges fees. These are usually a subset of the `amount` field and are used to provide more detailed information about the transaction.
     *
     * @param AdditionalAmounts|AdditionalAmountsShape $additionalAmounts
     */
    public function withAdditionalAmounts(
        AdditionalAmounts|array $additionalAmounts
    ): self {
        $self = clone $this;
        $self['additionalAmounts'] = $additionalAmounts;

        return $self;
    }

    /**
     * The balance amount in the minor unit of the account's currency. For dollars, for example, this is cents.
     */
    public function withBalance(int $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

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
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the account's currency.
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
     * If the authorization was made via a Digital Wallet Token (such as an Apple Pay purchase), the identifier of the token that was used.
     */
    public function withDigitalWalletTokenID(
        ?string $digitalWalletTokenID
    ): self {
        $self = clone $this;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;

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
    public function withMerchantCountry(string $merchantCountry): self
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
     * Fields specific to the `network`.
     *
     * @param NetworkDetails|NetworkDetailsShape $networkDetails
     */
    public function withNetworkDetails(
        NetworkDetails|array $networkDetails
    ): self {
        $self = clone $this;
        $self['networkDetails'] = $networkDetails;

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
     * The risk score generated by the card network. For Visa this is the Visa Advanced Authorization risk score, from 0 to 99, where 99 is the riskiest. For Pulse the score is from 0 to 999, where 999 is the riskiest.
     */
    public function withNetworkRiskScore(?int $networkRiskScore): self
    {
        $self = clone $this;
        $self['networkRiskScore'] = $networkRiskScore;

        return $self;
    }

    /**
     * If the authorization was made in-person with a physical card, the Physical Card that was used.
     */
    public function withPhysicalCardID(?string $physicalCardID): self
    {
        $self = clone $this;
        $self['physicalCardID'] = $physicalCardID;

        return $self;
    }

    /**
     * The identifier of the Real-Time Decision sent to approve or decline this transaction.
     */
    public function withRealTimeDecisionID(?string $realTimeDecisionID): self
    {
        $self = clone $this;
        $self['realTimeDecisionID'] = $realTimeDecisionID;

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
     * A constant representing the object's type. For this resource it will always be `card_balance_inquiry`.
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
     * Fields related to verification of cardholder-provided values.
     *
     * @param Verification|VerificationShape $verification
     */
    public function withVerification(Verification|array $verification): self
    {
        $self = clone $this;
        $self['verification'] = $verification;

        return $self;
    }
}
